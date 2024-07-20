<?php

// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; 

function cartCount()
{
	$userId = Auth::id();
    // $cart = Session::get('cart', []);
    // $count = 0;

    // foreach ($cart as $item) {
    //     $count += $item['quantity'];
    // }

    // return $count;
    if (!$userId) {
        return 0;
    }
    $count = Cart::where('user_id', $userId)->sum('qty');

    return $count;

}
