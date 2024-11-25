<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLevel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /// $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



        return view('home.index')->with([
            'books' => Book::getLatestBooks(),
        ]);
    }
}
