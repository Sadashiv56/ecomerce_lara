<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function cart()
    {
         if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'Please login to proceed to checkout.');
        }
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        return view('front.cart', compact('cartItems'));
    }
   

    public function addToCart($id)
    {
        if (!auth()->check()) {
            return redirect()->route('user.login')->with('error', 'You must be logged in to add products to the cart.');
        }

        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $userId = auth()->id();
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $id)
                        ->first();

        if ($cartItem) {
            $cartItem->qty += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'qty' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);
        $userId = auth()->id();
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $request->id)->first();
        if ($cartItem) {
            $cartItem->qty = $request->quantity;
            $cartItem->save();
            return redirect()->back()->with('success', 'Cart updated successfully');
        } else {
            return redirect()->back()->with('error', 'Cart item not found');
        }
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
        $userId = auth()->id();
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $request->id)->first();
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Product removed successfully');
        } else {
            return redirect()->back()->with('error', 'Cart item not found');
        }
    }
}
