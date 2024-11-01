<?php
// app/Http/Controllers/MomoAccountController.php
namespace App\Http\Controllers;

use App\Http\Requests\AddMomoAccountRequest;
use App\Services\MomoAccountService;
use App\Models\MomoAccount;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MomoAccountController extends Controller
{
    protected $momoAccountService;

    public function __construct(MomoAccountService $momoAccountService)
    {
        $this->momoAccountService = $momoAccountService;
    }

    public function store(AddMomoAccountRequest $request): RedirectResponse
    {
        // Gọi service để xử lý thêm tài khoản MoMo
        $this->momoAccountService->createMomoAccount($request->validated());

        // Trả về với thông báo thành công
        return redirect()->back()->with('success', 'Tài khoản MoMo đã được thêm thành công.');
    }
    public function index()
    {
        // Lấy dữ liệu từ bảng momo_accounts, có thể lấy dữ liệu của user hiện tại
        $momoAccounts = MomoAccount::where('user_id', auth()->id())->get();

        // Truyền dữ liệu tới view
        return view('gate.momo', compact('momoAccounts'));
    }
}
