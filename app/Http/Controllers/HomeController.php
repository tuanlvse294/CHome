<?php

namespace App\Http\Controllers;

use App\Offer;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{

    //those consts are used for searching
    const AREAS = ['all' => 'Diện tích', '-30' => "< 30 m2", '30-50' => "Từ 30-50 m2", '50-70' => "Từ 50-70 m2", '70-100' => "Từ 70-100 m2", '100-' => "> 100 m2",];
    const PRICES = ['all' => 'Mức giá', '-2' => "< 2 tỷ", '2-4' => "Từ 2 - 4 tỷ", '4-10' => "Từ 4 - 10 tỷ", '10-20' => "Từ 10 - 20 tỷ", '20-' => "> 20 tỷ",];
    const SORTS = ['time' => 'Tin mới nhất', 'asc' => "Giá thấp đến cao", 'des' => "Giá cao đến thấp"];
    const FRONTS = ['all' => 'Mặt tiền', '-3' => "< 3m", '3-5' => 'Từ 3-5m', '5-7' => 'Từ 5-7m', '7-10' => 'Từ 7-10m', '10-' => '> 10m'];

    //process searching
    public function index(Request $request)
    {
        if (\Auth::check() && (\Auth::user()->has_role('admin') || \Auth::user()->has_role('mod'))) { //you are admin or moderator?
            return redirect(url('admin')); //then go to admin panel then
        }
        $offers = Offer::query()->whereHas(
            'user', function ( $query) {
            $query->where('deleted_at', '=', null);
        })->where('accepted', '=', true); //here the searching goes, first we make sure only take accepted offers
        if ($request->has('query')) //search for name?
            $offers = $offers->where('title', 'like', "%" . $request->get('query') . "%"); //then find offers which has name contained the search query
        if ($request->has('city') and $request->get('city') != 'all') { //choosed a city?
            $offers = $offers->where('city_id', '=', $request->get('city')); //then only offers in this city
        }
        if ($request->has('district') and $request->get('district') != 'all') { //choosed a district?
            $offers = $offers->where('district_id', '=', $request->get('district')); //so so
        }
        if ($request->has('price') and $request->get('price') != 'all') { //want offers in a  price range only?
            $values = explode('-', $request->get('price')); //ok then, find out lower and upper, they are seperated by a minus sign
            $lower = (int)$values[0];
            $upper = (int)$values[1];
            if ($lower != 0) {
                $offers = $offers->where('price', '>=', $lower * 1000000000); //price is multiplied by 1 billion
            }
            if ($upper != 0) {
                $offers = $offers->where('price', '<=', $upper * 1000000000);
            }
        }
        if ($request->has('area') and $request->get('area') != 'all') {
            $values = explode('-', $request->get('area'));
            $lower = (int)$values[0];
            $upper = (int)$values[1];
            if ($lower != 0) {
                $offers = $offers->where('area', '>=', $lower);
            }
            if ($upper != 0) {
                $offers = $offers->where('area', '<=', $upper);
            }
        }
        if ($request->has('front') and $request->get('front') != 'all') {
            $values = explode('-', $request->get('front'));
            $lower = (int)$values[0];
            $upper = (int)$values[1];
            if ($lower != 0) {
                $offers = $offers->where('front', '>=', $lower);
            }
            if ($upper != 0) {
                $offers = $offers->where('front', '<=', $upper);
            }
        }


        if ($request->has('sort') and $request->get('sort') != 'time') { //you want another way to sort, not by time?
            if ($request->get('sort') == 'asc') { //price ascending then
                $offers = $offers->orderBy('price');
            } elseif ($request->get('sort') == 'des') {
                $offers = $offers->orderByDesc('price');
            }
        } else {
            $offers = $offers->orderByDesc('created_at'); //by time normally
        }
        $tops = Offer::get_top(2); //take 2 tops offers
        $offers = $offers->paginate(8); //and 8 more normal offers


        return view('home', ['offers' => $offers, 'tops' => $tops, 'areas' => HomeController::AREAS, 'prices' => HomeController::PRICES, 'sorts' => HomeController::SORTS, 'fronts' => HomeController::FRONTS]);
    }

    //API endpoint to render premiums each 10s
    public function get_premiums()
    {
        return view('offer.premiums');
    }
}
