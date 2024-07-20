<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripePaymentController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth:user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::get('/brands',[BrandController::class,'index'])->name('brands.index');
    Route::get('/brands/create',[BrandController::class,'create'])->name('brands.create');
    Route::post('/brands',[BrandController::class,'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit',[BrandController::class,'edit'])->name('brands.edit');
    Route::get('/brands/{brand}',[BrandController::class,'update'])->name('brands.update');
    Route::get('/brands/{brand}',[BrandController::class,'update'])->name('brands.destroy');
});
//user//
//produts//
//category//
//subcategory//
//brands route//
require __DIR__.'/auth.php';
/*admin route*/
Route::get('login-form',[AdminController::class,'login_form'])->name('login.form');
Route::post('login-functionality',[AdminController::class,'login_functionality'])->name('login.functionality');
Route::middleware('auth:admin')->group(function () {
Route::get('adminlogout',[AdminController::class,'adminlogout'])->name('adminlogout');
Route::get('adminHome',[AdminController::class,'adminHome'])->name('adminHome');
});
/*end*/
/*socialite route start*/  
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
/*end*/
Route::resource('maps', MapController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});
//helper function//
Route::get('call-helper', function(){
    $mdY = convertYmdToMdy('2022-02-12');
    var_dump("Converted into 'MDY': " . $mdY);
    $ymd = convertMdyToYmd('02-12-2022');
    var_dump("Converted into 'YMD': " . $ymd);
});
//front route start//
Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('/menu',[FrontController::class,'menu'])->name('menu');
Route::get('cart', [CartController::class, 'cart'])->name('front.cart');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
//user register and login route//
Route::get('/user/login', [AuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'userlogin']);
Route::get('/user/register', [AuthController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/user/register', [AuthController::class, 'userregister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//front route end //
//checkout//
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
// Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('checkout/success', function() {
    return view('checkout.success');
})->name('checkout.success');
Route::get('checkout/index', [CheckoutController::class, 'index'])->name('checkout.index');
//payment//
Route::get('payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::post('/stripe-post', [CheckoutController::class, 'stripePost'])->name('stripe.post');

Route::get('/stripe-success/{id}', [CheckoutController::class, 'stripeSuccess'])->name('stripe.success');

Route::get('/stripe-cancel', [CheckoutController::class, 'stripeCancel'])->name('stripe.cancel');