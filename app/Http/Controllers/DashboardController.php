<?php

namespace App\Http\Controllers;

use App\Offer;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('start')) {
            $start = $request->get('start');
        } else {
            $start = 'today - 6 day';
        }
        $start = new Carbon($start);


        if ($request->has('end')) {
            $end = $request->get('end');
        } else {
            $end = 'today';
        }

        $end = new Carbon($end);
        $end = $end->addDay(1);
        $end = $end->addSecond(-1);

        FlashToOld::flash_to_old($start->format('M d, Y'), 'start');
        FlashToOld::flash_to_old($end->format('M d, Y'), 'end');

        $period = Period::create($start, $end);
        $totalVisitorsAndPageViews = \Analytics::fetchTotalVisitorsAndPageViews($period);

        $generalChart = new Chart;
        $generalChart->title("Thống kê truy cập", 40);
        $generalChart->labels($totalVisitorsAndPageViews->pluck('date')->map(function ($item, $key) {
            return $item->format('d/m/y');
        }));

        $generalChart->dataset('Số khách', 'line', $totalVisitorsAndPageViews->pluck('visitors'))->color('#32ff7e');
        $generalChart->dataset('Lượt truy cập', 'line', $totalVisitorsAndPageViews->pluck('pageViews'))->color('#F2711C');

        $topBrowsers = \Analytics::fetchTopBrowsers($period);
        $browsersChart = new Chart;
        $browsersChart->minimalist(true);
        $browsersChart->displayLegend(true);
        $browsersChart->title("Trình duyệt");
        $browsersChart->labels($topBrowsers->pluck('browser'));
        $browsersChart->dataset('Lượt truy cập', 'pie', $topBrowsers->pluck('sessions'))->color('#F2711C');

        $userTypes = \Analytics::fetchUserTypes($period);
        $userTypesChart = new Chart;
        $userTypesChart->minimalist(true);
        $userTypesChart->displayLegend(true);
        $userTypesChart->title("Loại khách");
        $userTypesChart->labels($userTypes->pluck('type'));
        $userTypesChart->dataset('Loại khách', 'pie', $userTypes->pluck('sessions'))->color('#d81b60');


        return view('dashboard.index', ['title' => 'Thống kê', 'generalChart' => $generalChart, 'browsersChart' => $browsersChart,'userTypesChart'=>$userTypesChart]);
    }
}
