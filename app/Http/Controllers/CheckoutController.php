<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'email'   => 'required|email|max:255', // Thêm email vào validation
        ]);

        // Lấy giỏ hàng từ session
        $cart = session('cart', []);

        // Kiểm tra giỏ hàng
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Tính tổng tiền
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Lưu thông tin đơn hàng
        $order = Order::create([
            'user_id'          => Auth::id(), // Nếu không có user, hãy để NULL
            'customer_name'    => $request->name,
            'customer_phone'   => $request->phone,
            'customer_address' => $request->address,
            'payment_method'   => 'cod', // Thanh toán khi nhận hàng
            'cart'             => json_encode($cart), // Chuyển giỏ hàng thành JSON
            'total'            => $total, // Tổng tiền
        ]);

        // Gửi email xác nhận đơn hàng
        if (Auth::check()) {
            // Gửi email đến email của người dùng đã đăng nhập
            Mail::to(Auth::user()->email)->send(new \App\Mail\OrderConfirmationMail($order));
        } else {
            // Gửi email đến email được nhập trong form
            Mail::to($request->email)->send(new \App\Mail\OrderConfirmationMail($order));
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        session()->forget('cart');

        return redirect()->route('orders.success')->with('success', 'Đặt hàng thành công!');
    }

    public function success()
    {
        return view('orders.success');
    }
}