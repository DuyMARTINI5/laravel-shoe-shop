<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Lấy danh sách sản phẩm nổi bật
        $featuredProducts = Product::where('is_featured', true)->get();

        // Truyền biến $featuredProducts vào view
        return view('home', compact('featuredProducts'));
    }
}
