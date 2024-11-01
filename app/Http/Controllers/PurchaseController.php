<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;

class PurchaseController extends Controller
{
    public function purchase()
    {
        return view('purchase.card');
    }
    public function showPurchaseForm()
    {
        return view('purchase.form');
    }

    public function processPurchase(Request $request)
    {
        // Validate input
        $request->validate([
            'amount' => 'required|numeric|min:10', // Ví dụ: tối thiểu 10 USD
            'stripeToken' => 'required',
        ]);

        $amount = $request->input('amount');
        $stripeToken = $request->input('stripeToken');

        try {
            // Cấu hình Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            // Tạo charge
            $charge = Charge::create([
                'amount' => $amount * 100, // Stripe yêu cầu tính bằng cents
                'currency' => 'usd',
                'description' => 'Deposit for user ID: ' . Auth::id(),
                'source' => $stripeToken,
            ]);

            // Cập nhật số dư người dùng
            $user = Auth::user();
            $user->balance += $amount;
            $user->save();

            return redirect()->back()->with('success', 'Nạp tiền thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi nạp tiền: ' . $e->getMessage());
        }
    }
}
