<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        return view('home', ['offers' => $offers, 'areas' => HomeController::AREAS, 'prices' => HomeController::PRICES, 'sorts' => HomeController::SORTS, 'fronts' => HomeController::FRONTS]);
    }
}
