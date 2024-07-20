<?php
namespace App\Http\Controllers;
use Stripe\Charge;
use Stripe;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    public function checkout()
    {    
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'Please login to proceed to checkout.');
        }
        $userId = auth()->id();
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('front.checkout', compact('cartItems'));
    }
    public function payment()
    {
        return view('stripe.create');
    }
    public function stripePost(Request $request)
    {
        try {
            $userId = auth()->id();
            $cart = Cart::where('user_id', auth()->id())->with('product')->get();
             if ($cart->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
            }
            $subtotal = $cart->sum(function ($item) {
            return $item->product->price * $item->qty;
            });
            $shipping = 20;
            $total = $subtotal + $shipping;
            $order = Order::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country' => $request->country,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'mobile' => $request->mobile,
                'order_notes' => $request->order_notes,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'payment_status' => 'pending'
            ]);
             // Create order items
            foreach ($cart as $item) {
                if ($item->product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->qty,
                        'price' => $item->product->price,
                        'total' => $item->product->price * $item->qty
                    ]);
                } else {
                    return redirect()->route('checkout')->with('error', 'Product data is missing.');
                }
            }
            // Process the payment with Stripe
            // dd(env('APP_URL'));
            $stripe = new Stripe\StripeClient(env('STRIPE_SECRET'));
            $stripeSecret = config('services.stripe.secret');
            $stripe = new Stripe\StripeClient($stripeSecret);
            // dd($stripe);
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $total * 100, // amount in cents
                         'product_data' => [
                                'name' => 'Jenny Rosen',
                            ],
                    ],
                    'quantity' => count($cart),
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success', $order->id),
                'cancel_url' => route('stripe.cancel'),
            ]);
            // dd($session);
            // Store payment details
            $res=Payment::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'payment_id' => $session->id,
                'amount' => $total,
                'currency' => 'usd',
                'status' => 'pending'
            ]);
            // dd($res);
            // Redirect to Stripe payment page
            return redirect()->away($session->url);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('front.home')->with('error', 'Error processing payment: ' . $e->getMessage());
        }
    }
    public function stripeSuccess($id)
    {
        try {
            // Retrieve the order
            $order = Order::findOrFail($id);
            // Retrieve and update the payment
            $payment = Payment::where('order_id', $order->id)->first();
            if ($payment) {
                $payment->status = 'paid';
                $payment->save();
            }
            // Update the order status
            $order->payment_status = 'completed';
            $order->save();
            // Clear user's cart
            $userId = Auth::id();
            Cart::where('user_id', $userId)->delete();
            // Redirect to the home page with a success message
            return redirect()->route('front.home')->with('success', 'Payment successful! Your order has been placed.');

        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error in stripeSuccess: ' . $e->getMessage());
            return redirect()->route('stripe.cancel')->with('error', 'Payment failed!');
        }
    }
    public function stripeCancel()
    {
        return redirect()->route('checkout')->with('error', 'Payment was cancelled.');
    }

}
