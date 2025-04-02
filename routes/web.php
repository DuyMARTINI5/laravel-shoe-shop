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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Public Routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/cart/add/{id}', function ($id) {
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
})->name('cart.add');

Route::get('/cart', fn() => view('cart', ['cart' => session()->get('cart', [])]))->name('cart');

Route::get('/remove-from-cart/{id}', function ($id) {
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);
    return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
})->name('cart.remove');

Route::post('/update-cart', function (Request $request) {
    $cart = session()->get('cart', []);
    $id = $request->id;
    $quantity = $request->quantity;
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $quantity;
        session()->put('cart', $cart);
    }
    return back()->with('success', 'Đã cập nhật số lượng');
})->name('cart.update');

Route::get('/checkout', fn() => view('checkout', ['cart' => session()->get('cart', [])]))->name('checkout');

Route::post('/checkout', function (Request $request) {
    $cart = session()->get('cart', []);
    if (!$cart || count($cart) == 0) {
        return redirect('/')->with('error', 'Giỏ hàng rỗng!');
    }

    $total = collect($cart)->reduce(fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);

    $order = Order::create([
        'user_id' => auth()->check() ? auth()->id() : null,
        'customer_name' => $request->name,
        'customer_phone' => $request->phone,
        'customer_address' => $request->address,
        'cart' => json_encode($cart),
        'total' => $total,
    ]);

    Mail::send('emails.order', ['order' => $order], function ($message) use ($order) {
        $message->to('email@example.com');
        $message->subject('Xác nhận đơn hàng #' . $order->id);
    });

    session()->forget('cart');
    return redirect()->route('order.invoice.view', ['id' => $order->id])->with('success', 'Đặt hàng thành công!');
});

Route::get('/category/{id}', function ($id) {
    $category = Category::findOrFail($id);
    $products = $category->products()->latest()->get();
    return view('category-products', compact('products', 'category'));
})->name('category.products');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Invoice View (hiển thị view hóa đơn trên trình duyệt)
Route::middleware('auth')->get('/order/{id}/invoice/view', function ($id) {
    $order = Order::findOrFail($id);

    if (auth()->id() !== $order->user_id && !auth()->user()->is_admin) {
        abort(403);
    }

    return view('invoice', compact('order'));
})->name('order.invoice.view');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $monthlyOrders = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total) as revenue, COUNT(*) as order_count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartLabels = $monthlyOrders->pluck('month')->map(fn($m) => 'Tháng ' . $m);
        $chartRevenue = $monthlyOrders->pluck('revenue');
        $chartOrders = $monthlyOrders->pluck('order_count');

        return view('admin.dashboard', [
            'orders_count' => Order::count(),
            'users_count' => User::count(),
            'products_count' => Product::count(),
            'revenue' => Order::sum('total'),
            'chartLabels' => $chartLabels,
            'chartRevenue' => $chartRevenue,
            'chartOrders' => $chartOrders,
        ]);
    })->name('dashboard');

    Route::resource('products', AdminProductController::class)->names('products');
    Route::resource('orders', OrderController::class)->names('orders');
    Route::resource('categories', CategoryController::class)->names('categories');

    Route::get('products/export/csv', [AdminProductController::class, 'exportCsv'])->name('products.export.csv');
    Route::get('products/export/excel', [AdminProductController::class, 'exportExcel'])->name('products.export.excel');
});

// PDF Invoice Download
Route::middleware('auth')->get('/order/{id}/invoice', function ($id) {
    $order = Order::findOrFail($id);

    if (auth()->id() !== $order->user_id && !auth()->user()->is_admin) {
        abort(403);
    }

    $pdf = Pdf::loadView('invoice', compact('order'));
    return $pdf->download('hoa_don_don_hang_' . $order->id . '.pdf');
})->name('order.invoice');

Route::get('/search', function (Request $request) {
    $query = $request->input('q');
    $products = Product::where('name', 'like', "%{$query}%")->get();
    return view('search-results', compact('products', 'query'));
});
