<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class HomeController extends Controller
{


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
