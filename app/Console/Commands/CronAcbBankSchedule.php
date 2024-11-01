<?php

namespace App\Console\Commands;

use App\Models\BankTransLog;
use App\Models\Package;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayAccount;
use App\Models\ServerLogger;
use App\Models\Setting;
use App\Services\BankApi\AcbBankApiService;
use App\Services\MetechRequestSecurity;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CronAcbBankSchedule extends Command
{
    const SLEEP_TIME = 30;
    const MAX_FLAG = 30;

    private $metechRequestSecurity;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:cron-acb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron bank service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->metechRequestSecurity = new MetechRequestSecurity();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {


        $setting = Setting::whereName(Setting::NAMES['ACB_RUN'])->first();
        $paymentGateway = PaymentGateway::whereBrand(PaymentGateway::BRANDS['ACB'])->first();

        $checkRun = $setting->value;
        $flag = $paymentGateway->flag;
        // $this->info("checkRun: $checkRun");
        // $this->info("flag: $flag");


        // Kiểm tra settting có cho cron acb hay ko
        if ($checkRun) {

            // Nếu đang có phiên cron khác thì exit
            if ($flag > 0) {
                exit("Đang có cron khác chạy,không chạy cron hiện tại");
            }

            // $this->info("-------------------------------------------------\n");
            return $this->runCron($flag, $paymentGateway);
        }

        exit();
    }

    public function runCron($flag = 0, $paymentGateway)
    {
        try {
            if ($flag >= self::MAX_FLAG) {
                // Cron đã chạy lặp quá MAX_FLAG = 30 lần

                $paymentGateway->updateRecord(['flag' => 0]);
                $paymentGateway->save();
                return true;
            }

            $this->info("LẦN CHẠY THỨ $flag");

            $flag++;
            $paymentGateway->updateRecord(['flag' => $flag]);
            $paymentGateway->save();

            // $this->info("Cron");


            // Lấy các paymentGatewayAccounts đã mua package còn hạn && là acb && là pause = false
            $paymentGatewayAccounts = PaymentGatewayAccount::with('paymentGateway')->where('payment_gateway_id', $paymentGateway->id)->where('pause', false)->whereHas('userPackage', function ($query) {
                $query->where('time_end', '>=', Carbon::today());
            })
                ->get();

            // cron paymentGatewayAccounts
            foreach ($paymentGatewayAccounts as $paymentGatewayAccount) {
                $this->cronPaymentGatewayAccount($paymentGatewayAccount);
            }

            // Tạm dừng
            sleep(self::SLEEP_TIME);

            return $this->runCron($flag, $paymentGateway);
        } catch (\Throwable $exception) {
            $setting = Setting::whereName(Setting::NAMES['ACB_RUN'])->first();
            $paymentGateway = PaymentGateway::whereBrand(PaymentGateway::BRANDS['ACB'])->first();

            $paymentGateway->updateRecord(['flag' => 0]);
            $paymentGateway->save();

            $setting->updateRecord(['value' => 0]);
            $setting->save();

            ServerLogger::create([
                'message' => $exception->getMessage()
            ]);
        }
        return true;
    }


    public function cronPaymentGatewayAccount($paymentGatewayAccount)
    {


        $paymentGatewayId = $paymentGatewayAccount->paymentGatewayId;

        // decode password
        $password = $paymentGatewayAccount->password;
        $descryptEncryptPassword =  $this->metechRequestSecurity->decodeDecrypt($password);

        // Lấy thông tin của accounts
        $accountName = $paymentGatewayAccount->accountName;
        $accountNo = $paymentGatewayAccount->accountNo;
        $oldToken = $paymentGatewayAccount->token;

        // $this->info("account no: " . $paymentGatewayAccount->accountNo);

        $acbBankApiService = new AcbBankApiService($accountName, $descryptEncryptPassword,  $oldToken, $accountNo);

        /*
        - Khi user lần đầu thêm tài khoản vào
                + Lần cron đầu tiên sẽ login tài khoản:
                    * Thành công: init -> ready
                    * Thất bại: init -> stop
                + Nếu lần cron đầu login thành công những lần sau sẽ chỉ lấy history:
                    * Trong history cho phép login lại 1 lần (nếu get history fail)
                        * login thành công -> tiếp tục
                        * login thất bại -> ready -> stop và yêu cầu người dùng thêm lại
            - stop và skip đều dùng để ngăn cản login và yêu cầu user đăng nhập lại nhưng khác ở chỗ stop là sai ở lần đăng nhập đầu,
                skip là khi hết phiên hoặc có sự thay đổi thông tin
        */
        // status === 'INIT' => Tài khoản mới thêm lần đầu (Hoặc mới cập nhập password) => login lần đầu
        if ($paymentGatewayAccount->status === PaymentGatewayAccount::STATUSES['INIT']) {
            $login = $acbBankApiService->login();
            // login thành công, chuyển status thành ready
            if ($login && $login['status'] === true) {
                $paymentGatewayAccount->updateRecord(['status' => PaymentGatewayAccount::STATUSES['READY'], 'token' => $acbBankApiService->accessToken]);
                $paymentGatewayAccount->save();
            }
            // login thất bại, chuyển status thành STOP và return
            else {
                $paymentGatewayAccount->updateRecord(['status' => PaymentGatewayAccount::STATUSES['STOP']]);
                $paymentGatewayAccount->save();
                // $this->info("INIT => STOP");
                // $this->info("\n");

                return;
            }
        }
        //status là STOP || SKIP => dừng lại để ko login sai quá nhiều lần
        else if (
            $paymentGatewayAccount->status === PaymentGatewayAccount::STATUSES['STOP'] ||
            $paymentGatewayAccount->status === PaymentGatewayAccount::STATUSES['SKIP']
        ) {
            // $this->info("STOP || SKIP");
            // $this->info("\n");
            return;
        }

        // status === READY

        $response = $acbBankApiService->history();


        if ($response['status'] === true) {

            $transactions = $response['data']['data']['transactions'];


            foreach ($transactions as $transaction) {

                $transactionId = $transaction['transactionNumber'];
                $amount = $transaction['amount'];
                $description = $transaction['description'];
                $type = $transaction['type'];
                $transactionNumber = $transaction['transactionNumber'];

                ///////////////////////
                // Lấy giá trị transactionDate từ mảng dữ liệu
                $transactionDateTimestamp = $transaction['activeDatetime'];

                // Chuyển đổi timestamp thành đối tượng DateTime
                $transactionDate = Carbon::createFromTimestamp($transactionDateTimestamp / 1000);
                $balance = $transaction['amount'];
                ///////////////////////


                $objectData = json_encode($transaction);

                // Kiểm tra đã tồn tại BankTransLog với primary key là 3 biến trên chưa
                $bankTransLog = BankTransLog::where('account_no', $accountNo)
                    ->where('payment_gateway_id', $paymentGatewayId)
                    ->where('transaction_id', $transactionId)
                    ->first();

                if ($bankTransLog === null) {
                    // Tạo mới bản ghi BankTransLog nếu chưa tồn tại
                    BankTransLog::createNewRecord(compact(
                        'accountNo',
                        'transactionId',
                        'paymentGatewayId',
                        'amount',
                        'description',
                        'transactionDate',
                        'type',
                        'balance',
                        'objectData'
                    ));
                }
            }


            $token = $acbBankApiService->getAccessToken();
            $paymentGatewayAccount->updateRecord(['lastCron' => Carbon::now(), 'token' => $token]);

            $this->info("Thành công");
            // $this->info("LastCron updated for PaymentGatewayAccount: $paymentGatewayAccount->accountNo");
            // Log::debug('Thành công');
            // Log::debug('LastCron updated for PaymentGatewayAccount: ' . $paymentGatewayAccount->id);
        } else {
            $errorMessage = $response['message'];
            $paymentGatewayAccount->updateRecord(['status' => PaymentGatewayAccount::STATUSES['SKIP']]);
            $paymentGatewayAccount->save();
            // Log::debug('Thất bại ' . $errorMessage);
            $this->info("Thất bại . $errorMessage");
        }

        if ($oldToken === $token) {
            $this->info('Old login');
        } else {
            $this->info('New login');
        }
    }
}
