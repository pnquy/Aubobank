<?php

namespace App\Http\Middleware\Frontend;

use App\Models\PaymentGateway;
use Closure;
use Illuminate\Http\Request;

class CheckPaymentGatewayStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $paymentGateway = $request->route('paymentGateway');

        $status = $paymentGateway->status;



        if ($status === PaymentGateway::STATUSES['MAINTENANCE']) {
            return response()->view('frontend.payment_gateway.maintenance');
        } else if ($status === PaymentGateway::STATUSES['COMMING_SOON']) {
            return redirect("/");
        }


        return $next($request);
    }
}
