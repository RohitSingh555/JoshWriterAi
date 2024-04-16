<?php

namespace App\Http\Controllers;

use App\Models\PaymentLogs;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;

class StripeController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }
    public function purchase()
    {
        return view('frontend.purchase');
    }
    public function payment_log()
    {
        $data['payment_logs'] = PaymentLogs::with('user')->orderBy('user_id', 'DESC')->get();
        return view('admin.payment.index', $data);
    }
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'tokens' => 'required',
        ]);
        if ($validator->passes()) {
            $paymentIntent = $this->stripe->paymentIntents->create(
                [
                    'amount' => $request->amount * 100,
                    'currency' => 'usd',
                    'automatic_payment_methods' => ['enabled' => true],
                ],
            );
            Session::put('amount', $request->amount);
            Session::put('tokens', $request->tokens);
            $response['clientSecret'] = $paymentIntent->client_secret;
            $response['url'] = route('payment_confirmed');
            return view('frontend.checkout', $response);
        } else {
            $response['status'] = 'Failure';
            $response['result'] = $validator->errors()->toJson();
        }
        return view('frontend.purchase', $response);
    }
    public function payment_confirmed(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $tokens = $user->lastTokens + Session::get('tokens');
        User::where('id', Auth::user()->id)->update(['lastTokens' => $tokens]);
        PaymentLogs::create([
            'payment_intent' => $request->payment_intent,
            'amount' => Session::get('amount'),
            'tokens' => Session::get('tokens'),
            'user_id' => Auth::user()->id,
        ]);
        Session::forget('amount');
        Session::forget('tokens');
        Session::put('payment', 'Success');
        return redirect()->route('Home')->with('success', 'Payment Successful, Tokens Added!');
    }
}
