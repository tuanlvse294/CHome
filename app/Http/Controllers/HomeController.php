<?php

namespace App\Http\Controllers;

use App\Offer;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::query()->paginate(10);
        return view('home', ['offers' => $offers]);
    }
}
