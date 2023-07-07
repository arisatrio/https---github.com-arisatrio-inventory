<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use App\Models\ProdukTipe;
use App\Models\User;

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
        return view('home', [
            'totalPo' => Order::where('is_selesai', 1)->count(),
            'totalRp' => Order::where('is_selesai', 1)->sum('grand_total'),
            'totalCust' => User::role('Customer')->count(),
            'totalProduk' => ProdukTipe::count(),
        ]);
    }
}
