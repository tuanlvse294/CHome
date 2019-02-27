<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{

    const AREAS = ["< 30 m2", "Từ 30-50 m2", "Từ 50-70 m2", "Từ 70-100 m2", "> 100 m2",];

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
        return view('home', ['offers' => $offers, 'areas' => $this::AREAS]);
    }
}
