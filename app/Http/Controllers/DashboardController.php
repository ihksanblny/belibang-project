<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function showDashboard(){
        $my_products = Product::where('creator_id', Auth::id())->get();
        $my_revenue = ProductOrder::where('creator_id', Auth::id())->where('is_paid', 1)->sum('total_price');
        $total_order_success = ProductOrder::where('creator_id', Auth::id())->where('is_paid', 1)->get();

        return view('dashboard', [
            'my_products' => $my_products,
            'my_revenue' => $my_revenue,
            'total_order_success' => $total_order_success,

        ]);
    }

}
