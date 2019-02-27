<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{

    const AREAS = ['all' => 'Diện tích', '0-30' => "< 30 m2", '30-50' => "Từ 30-50 m2", '50-70' => "Từ 50-70 m2", '70-100' => "Từ 70-100 m2", '100-' => "> 100 m2",];
    const PRICES = ['all' => 'Mức giá', '-2' => "< 2 tỷ", '2-4' => "Từ 2 - 4 tỷ", '4-10' => "Từ 4 - 10 tỷ", '10-20' => "Từ 10 - 20 tỷ", '20-' => "> 20 tỷ",];
    const SORTS = ['time' => 'Tin mới nhất', 'asc' => "Giá thấp đến cao", 'des' => "Giá cao đến thấp"];
    const FRONTS = ['all' => 'Mặt tiền', '-3' => "< 3m", '3-5' => 'Từ 3-5m', '5-7' => 'Từ 5-7m', '7-10' => 'Từ 7-10m', '10-' => '> 10m'];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offers = Offer::query();

        if ($request->has('query'))
            $offers = $offers->where('title', 'like', "%" . $request->get('query') . "%");
        if ($request->has('city') and $request->get('city') != 'all')
            $offers = $offers->where('city_id', '=', $request->get('city'));
        if ($request->has('district') and $request->get('district') != 'all')
            $offers = $offers->where('district_id', '=', $request->get('district'));
        $offers = $offers->paginate(10);
        return view('home', ['offers' => $offers, 'areas' => HomeController::AREAS, 'prices' => HomeController::PRICES, 'sorts' => HomeController::SORTS, 'fronts' => HomeController::FRONTS]);
    }
}
