<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\frontend\ApiToolController;
use App\Http\Controllers\frontend\EcaptchaControler;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\frontend\IntegrationController;
use App\Http\Controllers\Frontend\PaymentGatewayController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\frontend\PaymentGatewayAccountController;
use App\Http\Controllers\frontend\UserPackageController;
use App\Http\Controllers\frontend\ScointController;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayAccount;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect("/home");
    })->name('index');

    Route::prefix('home')->name('home.')->group(function () {
        Route::get('/', function () {
            return redirect("/home/dashboard");
        })
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->push(__('Trang chủ'), route('frontend.home.index'));
            });

        Route::get('/dashboard', [HomeController::class, 'index'])
            ->name('dashboard')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.home.index')->push(__('Tổng quan'), route('frontend.home.dashboard'));
            });
    });



    Route::prefix('payment-gateways/{paymentGateway:brand}')
        ->name('payment_gateway.')
        ->group(function () {

            Route::get('/', [PaymentGatewayController::class, 'paymentGatewayListAccountView'])
                ->name('index')
                ->breadcrumbs(function (Trail $trail, PaymentGateway $paymentGateway) {
                    $trail->parent('frontend.home.index')->push(__($paymentGateway->name), route('frontend.payment_gateway.index', ['paymentGateway' => $paymentGateway]));
                });

            Route::get('/add', [PaymentGatewayController::class, 'paymentGatewayAddAccountView'])
                ->name('add')
                ->breadcrumbs(function (Trail $trail, PaymentGateway $paymentGateway) {
                    $trail->parent('frontend.payment_gateway.index', $paymentGateway)->push(__("Thêm tài khoản"), route('frontend.payment_gateway.add', ['paymentGateway' => $paymentGateway]));
                });

            Route::post('/add', [PaymentGatewayController::class, 'addPaymentGatewayAccount'])
                ->name('add_account');

            Route::post('/add-account-otp-verify', [PaymentGatewayController::class, 'addPaymentGatewayAccountVerifyOtp'])
                ->name('add_account_otp_verify');





            Route::prefix('/{paymentGatewayAccount:id}')->name('payment_gateway_account.')
                ->group(function () {
                    Route::get('/', [PaymentGatewayAccountController::class, 'index'])
                        ->name('index')
                        ->breadcrumbs(function (Trail $trail, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount) {
                            $trail->parent('frontend.payment_gateway.index', $paymentGateway)->push(__($paymentGatewayAccount->accountNo), route('frontend.payment_gateway.payment_gateway_account.index', ['paymentGateway' => $paymentGateway, 'paymentGatewayAccount' => $paymentGatewayAccount]));
                        });

                    Route::get('/receive-history', [PaymentGatewayAccountController::class, 'paymentGatewayAccountReceiveHistoryView'])
                        ->name('receive_history')
                        ->breadcrumbs(function (Trail $trail, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount) {
                            $trail->parent('frontend.payment_gateway.payment_gateway_account.index', $paymentGateway, $paymentGatewayAccount)->push(__("Lịch sử nhận tiền"), route('frontend.payment_gateway.payment_gateway_account.receive_history', ['paymentGateway' => $paymentGateway, 'paymentGatewayAccount' => $paymentGatewayAccount]));
                        });

                    Route::get('/transfer-history', [PaymentGatewayAccountController::class, 'paymentGatewayAccountTransferHistoryView'])
                        ->name('transfer_history')
                        ->breadcrumbs(function (Trail $trail, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount) {
                            $trail->parent('frontend.payment_gateway.payment_gateway_account.index', $paymentGateway, $paymentGatewayAccount)->push(__("Lịch sử chuyển tiền"), route('frontend.payment_gateway.payment_gateway_account.transfer_history', ['paymentGateway' => $paymentGateway, 'paymentGatewayAccount' => $paymentGatewayAccount]));
                        });

                    Route::get('/transfer-money', [PaymentGatewayAccountController::class, 'paymentGatewayAccountTransferMoneyView'])
                        ->name('transfer_money')
                        ->breadcrumbs(function (Trail $trail, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount) {
                            $trail->parent('frontend.payment_gateway.payment_gateway_account.index', $paymentGateway, $paymentGatewayAccount)->push(__("Chuyển tiền"), route('frontend.payment_gateway.payment_gateway_account.transfer_money', ['paymentGateway' => $paymentGateway, 'paymentGatewayAccount' => $paymentGatewayAccount]));
                        });

                    Route::post('/transfer', [PaymentGatewayAccountController::class, 'paymentGatewayAccountTransferMoney'])
                        ->name('transfer');



                    Route::post('/get-token', [PaymentGatewayAccountController::class, 'getToken'])
                        ->name('get_token');

                    Route::post('/delete', [PaymentGatewayAccountController::class, 'delete'])
                        ->name('delete');


                    Route::post('/pause', [PaymentGatewayAccountController::class, 'pause'])
                        ->name('pause');

                    Route::post('/update', [PaymentGatewayAccountController::class, 'update'])
                        ->name('update');
                    Route::post('/update-info', function () {
                        return redirect()->back();
                    })
                        ->name('update_info');
                });
        });





    Route::prefix('/scoint')->name('scoint.')
        ->group(function () {

            Route::get('/', [ScointController::class, 'index'])
                ->name('index')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.home.index')->push(__('Scoint'), route('frontend.scoint.index'));
                });



            Route::get('/deposit', [ScointController::class, 'depositView'])
                ->name('deposit_view')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.scoint.index')->push(__('Nạp tiền'), route('frontend.scoint.deposit_view'));
                });

            Route::post('/deposit', [ScointController::class, 'deposit'])
                ->name('deposit');


            Route::post('/transfer', [ScointController::class, 'transfer'])
                ->name('transfer');

            Route::get('/transfer', [ScointController::class, 'transferView'])
                ->name('transfer_view')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.scoint.index')->push(__('Chuyển tiền'), route('frontend.scoint.transfer_view'));
                });

            Route::get('/history', [ScointController::class, 'historyView'])
                ->name('history_view')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.scoint.index')->push(__('Lịch sử'), route('frontend.scoint.history_view'));
                });
        });





    Route::get('/upgrade', [PackageController::class, 'index'])
        ->name('upgrade')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.home.index')->push(__('Nâng cấp'), route('frontend.upgrade'));
        });

    Route::prefix('/user-package')->name('user_package.')
        ->group(function () {
            Route::post("upgrade",  [UserPackageController::class, 'upgradeAccount'])->name("upgrade");
        });


    Route::get('/upgrade', [PackageController::class, 'index'])
        ->name('upgrade')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.home.index')->push(__('Nâng cấp'), route('frontend.upgrade'));
        });


    Route::get('/reputable-website', [HomeController::class, 'index'])
        ->name('reputable_website')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.home.index')->push(__('Website uy tín'), route('frontend.reputable_website'));
        });


    Route::prefix('/user')->name('user.')
        ->group(function () {
            Route::get('/', [UserController::class, 'profileView'])
                ->name('index')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.home.index')->push(__('Tài khoản'), route('frontend.user.index'));
                });



            Route::post('/update-profile', [UserController::class, 'updateProfile'])
                ->name('update_profile');


            Route::get('/change-password', [UserController::class, 'changePasswordView'])
                ->name('change_password')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.home.index')->push(__('Đổi mật khẩu'), route('frontend.user.change_password'));
                });

            Route::post('/update-password', [UserController::class, 'updatePassword'])
                ->name('update_password');
        });






    Route::prefix('/ecaptcha')->name('ecaptcha.')
        ->group(function () {

            Route::get('/', [EcaptchaControler::class, 'index'])
                ->name('index')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.home.index')->push(__('Ecaptcha'), route('frontend.ecaptcha.index'));
                });



            Route::get('/history', [EcaptchaControler::class, 'historyView'])
                ->name('history_view')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.ecaptcha.index')->push(__('Lịch sử eCaptcha'), route('frontend.ecaptcha.history_view'));
                });

            Route::prefix('/{paymentGateway:brand}')
                ->name('payment_gateway.')
                ->group(function () {
                    Route::get('/', [EcaptchaControler::class, 'paymentGatewayDocumentView'])
                        ->name('index')
                        ->breadcrumbs(function (Trail $trail, PaymentGateway $paymentGateway) {
                            $trail->parent('frontend.ecaptcha.index')->push(__($paymentGateway->name), route('frontend.ecaptcha.payment_gateway.index', ['paymentGateway' => $paymentGateway]));
                        });
                });
        });


    Route::prefix('/api-tool')->name('api_tool.')
        ->group(function () {

            Route::get('/', [ApiToolController::class, 'index'])
                ->name('index')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.home.index')->push(__('Công cụ API'), route('frontend.api_tool.index'));
                });



            Route::get('/test-momo-transaction-code', [ApiToolController::class, 'testMomoTransactionCodeView'])
                ->name('test_momo_transaction_code')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.api_tool.index')->push(__('Kiểm thử mã giao dịch Momo'), route('frontend.api_tool.test_momo_transaction_code'));
                });


            Route::get('/test-wallet-api', [ApiToolController::class, 'testWalletApiView'])
                ->name('test_wallet_api')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.api_tool.index')->push(__('Kiểm thử api ví điện tử'), route('frontend.api_tool.test_wallet_api'));
                });


            Route::get('/test-bank-api', [ApiToolController::class, 'testBankApiView'])
                ->name('test_bank_api')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.api_tool.index')->push(__('Kiểm thử api ngân hàng'), route('frontend.api_tool.test_bank_api'));
                });

            Route::get('/create-bank-qrcode', [ApiToolController::class, 'createBankQrCode'])
                ->name('create_bank_qrcode')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.api_tool.index')->push(__('Hệ thống tạo QR code ngân hàng'), route('frontend.api_tool.create_bank_qrcode'));
                });
        });



    Route::prefix('/integration')->name('integration.')
        ->group(function () {

            Route::get('/', [IntegrationController::class, 'index'])
                ->name('index')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.home.index')->push(__('Tích hợp'), route('frontend.integration.index'));
                });

            Route::get('/wordpress', [IntegrationController::class, 'listView'])
                ->name('wordpress')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.integration.index')->push(__('Plugin WordPress'), route('frontend.integration.wordpress'));
                });


            Route::get('/whmcs', [IntegrationController::class, 'listView'])
                ->name('whmcs')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.integration.index')->push(__('Module WHMCS'), route('frontend.integration.whmcs'));
                });
        });
});


function generateRandomString($length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+=-';
    $randomString = '';
    $characterLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $characterLength - 1)];
    }

    return $randomString;
}
