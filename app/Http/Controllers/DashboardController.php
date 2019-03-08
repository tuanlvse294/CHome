<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        return view('dashboard.index', ['title' => 'Thống kê']);
    }
}
