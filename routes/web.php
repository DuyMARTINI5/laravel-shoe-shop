<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/add-to-cart/{id}', function (Request $request, $id) {
    $product = \App\Models\Product::findOrFail($id);
    $cart = session()->get('cart', []);
    $cart[$id] = [
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => ($cart[$id]['quantity'] ?? 0) + 1,
        'image' => $product->image,
    ];
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
})->name('cart.add');

Route::get('/cart', fn() => view('cart', ['cart' => session('cart', [])]))->name('cart');

Route::get('/remove-from-cart/{id}', function ($id) {
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);
    return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
})->name('cart.remove');

Route::post('/update-cart', function (Request $request) {
    $cart = session()->get('cart', []);
    if (isset($cart[$request->id])) {
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
    }
    return back()->with('success', 'Đã cập nhật số lượng');
})->name('cart.update');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', fn() => view('checkout', ['cart' => session('cart', [])]))->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/my-orders', fn() => view('my-orders', ['orders' => Order::where('user_id', Auth::id())->latest()->get()]))->name('my-orders');
    Route::get('/profile', fn() => view('profile', ['user' => Auth::user()]))->name('profile');
});

Route::get('/orders/success', [CheckoutController::class, 'success'])->name('orders.success');
Route::get('/orders/invoice/{order}', [CheckoutController::class, 'invoice'])->name('orders.invoice');

Route::get('/paypal/checkout/{order}', [App\Http\Controllers\PayPalController::class, 'checkout'])->name('paypal.checkout');
Route::get('/momo/checkout/{order}', [App\Http\Controllers\MomoController::class, 'checkout'])->name('momo.checkout');
Route::get('/zalopay/checkout/{order}', [App\Http\Controllers\ZaloPayController::class, 'checkout'])->name('zalopay.checkout');

Route::get('/category/{id}', function ($id) {
    $category = \App\Models\Category::findOrFail($id);
    $products = $category->products()->latest()->get();
    return view('products.by_category', compact('category', 'products'));
})->name('category.products');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $monthlyOrders = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total) as revenue, COUNT(*) as order_count')
            ->groupBy('month')->orderBy('month')->get();

        return view('admin.dashboard', [
            'orders_count' => Order::count(),
            'users_count' => User::count(),
            'products_count' => Product::count(),
            'revenue' => Order::sum('total'),
            'chartLabels' => $monthlyOrders->pluck('month')->map(fn($m) => 'Tháng ' . $m),
            'chartRevenue' => $monthlyOrders->pluck('revenue'),
            'chartOrders' => $monthlyOrders->pluck('order_count'),
        ]);
    })->name('dashboard');

    Route::resource('products', AdminProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('products/export/csv', [AdminProductController::class, 'exportCsv'])->name('products.export.csv');
    Route::get('products/export/excel', [AdminProductController::class, 'exportExcel'])->name('products.export.excel');
});

Route::middleware(['auth', 'admin'])->get('/admin/order/{id}/invoice', function ($id) {
    $order = Order::findOrFail($id);
    $pdf = Pdf::loadView('invoice-pdf', compact('order'));
    return $pdf->download('hoa_don_don_hang_' . $order->id . '.pdf');
})->name('admin.order.invoice');

Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'showLinkRequestForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'reset')->name('password.update');
});

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
