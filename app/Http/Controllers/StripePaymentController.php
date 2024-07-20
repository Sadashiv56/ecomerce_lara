<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Session;
class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe.create');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        // dd($request->all());
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
            );
            $data = $stripe->checkout->sessions->create([
                'success_url' => route('stripe.success'),
                'cancel_url' => route('stripe.cancel'),
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'unit_amount' => 100 * 100,
                            'product_data' => [
                                'name' => 'Jenny Rosen',
                            ],
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
            ]);
                // dd($data,$data->url);
                return redirect()->away($data->url);
    }
    public function stripepayment()
    {
        return view('stripe.create');
    }
    public function stripeCancel()
    {
     	return view('stripe.cancel');   
    }
}
