<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\UserBookPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index')->with([
            'userPoints' => UserBookPoint::where('user_id', Auth::user()->id)->first(),
        ]);
    }

    public function yourBooks(Request $request)
    {
        return view('dashboard.your_books')->with([
            'books' => Book::getUserBooks(Auth::user()->id)
        ]);
    }


    public function yourOrders(Request $request)
    {

        // dd(Order::getUserOrders(Auth::user()->id));

        return view('dashboard.your_orders')->with([
            'orders' => Order::getUserOrders(Auth::user()->id)
        ]);
    }



    public function miniSearch(Request $request)
    {

        // dd(Order::getUserOrders(Auth::user()->id));

        return view('dashboard.mini_search')->with([
            // 'orders' => Order::getUserOrders(Auth::user()->id)
        ]);
    }
}
