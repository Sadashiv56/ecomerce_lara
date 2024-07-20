<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $product = Product::all();
    	return view('front.home',compact('product'));
    }

    public function menu()
    {
        return view('front.menu');
    }
}
