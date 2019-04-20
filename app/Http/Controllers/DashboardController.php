<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Transaction;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        list($start, $end) = $this->get_time($request);

        $period = Period::create($start, $end); //period is just a class hold time range
        $totalVisitorsAndPageViews = \Analytics::fetchTotalVisitorsAndPageViews($period); //fetch data from Google Analytics API

        $generalChart = new Chart; //create a new chart
        $generalChart->title("Thống kê truy cập", 40); //set title and font size
        $generalChart->labels($totalVisitorsAndPageViews->pluck('date')->map(function ($item, $key) {
            return $item->format('d/m/y');
        })); //take only date column from data and format all of it's rows to wanted format

        $generalChart->dataset('Số khách', 'line', $totalVisitorsAndPageViews->pluck('visitors'))->color('#32ff7e'); //create new dataset from visitors column

        $generalChart->dataset('Lượt truy cập', 'line', $totalVisitorsAndPageViews->pluck('pageViews'))->color('#F2711C');//create new dataset from pageViews column

        $topBrowsers = \Analytics::fetchTopBrowsers($period);
        $browsersChart = new Chart;
        $browsersChart->minimalist(true); //remove unneeded features
        $browsersChart->displayLegend(true); //show charts legends
        $browsersChart->title("Trình duyệt");
        $browsersChart->labels($topBrowsers->pluck('browser')); //chart's labels ( x axis)
        $browsersChart->dataset('Lượt truy cập', 'pie', $topBrowsers->pluck('sessions'))->color('#F2711C');

        $userTypes = \Analytics::fetchUserTypes($period);
        $userTypesChart = new Chart;
        $userTypesChart->minimalist(true);
        $userTypesChart->displayLegend(true);
        $userTypesChart->title("Loại khách");
        $userTypesChart->labels($userTypes->pluck('type'));
        $userTypesChart->dataset('Loại khách', 'pie', $userTypes->pluck('sessions'))->color('#d81b60');


        return view('dashboard.index', ['title' => 'Thống kê', 'generalChart' => $generalChart, 'browsersChart' => $browsersChart, 'userTypesChart' => $userTypesChart]);
    }

    //get annually revenue
    private static function getYears(Carbon $start, Carbon $end)
    {
        $years = $end->diffInYears($start); //how many years?
        $labels = [];
        $values = [];

        for ($i = 0; $i <= $years; $i++) { //go through each year
            $nextYear = $start->copy(); //need to clone the start
            $nextYear->addYear(1);
            $transactions = Transaction::query()->whereBetween('created_at', [$start, $nextYear])->get(); //get all transaction between two years
            $labels[] = $start->year; //label of this year
            $values[] = $transactions->pluck('amount')->sum(); //how much is this year's total?
            $start = $nextYear; //step to next year
        }
        return [$labels, $values];
    }

    private static function getMonths(Carbon $start, Carbon $end)
    {
        $months = $end->diffInMonths($start);
        $labels = [];
        $values = [];

        for ($i = 0; $i <= $months; $i++) {
            $nextMonth = $start->copy();
            $nextMonth->addMonth(1);
            $transactions = Transaction::query()->whereBetween('created_at', [$start, $nextMonth])->get();
            $labels[] = $start->year . '/' . $start->month;
            $values[] = $transactions->pluck('amount')->sum();
            $start = $nextMonth;
        }
        return [$labels, $values];
    }

    private function getDays(Carbon $start, Carbon $end)
    {
        $days = $end->diffInDays($start);
        $labels = [];
        $values = [];

        for ($i = 0; $i <= $days; $i++) {
            $nextDay = $start->copy();
            $nextDay->addDay(1);
            $transactions = Transaction::query()->whereBetween('created_at', [$start, $nextDay])->get();
            $labels[] = $start->year . '/' . $start->month . '/' . $start->day;
            $values[] = $transactions->pluck('amount')->sum();
            $start = $nextDay;
        }
        return [$labels, $values];
    }

    //want to see how much we earned?
    public function revenue(Request $request)
    {
        list($start, $end) = $this->get_time($request); //get time range first

        if ($end->diffInYears($start) > 2) { //if the range is mmore than 2 years
            [$labels, $values] = $this::getYears($start, $end); //we show annually chart
        } else if ($end->diffInMonths($start) > 3) { //more than 3 months?
            [$labels, $values] = $this::getMonths($start, $end);  //we show monthly chart
        } else { //or else
            [$labels, $values] = $this::getDays($start, $end); //we show daily chart
        }
        $revenueChart = new Chart;
        $revenueChart->title("Thống kê doanh thu", 40);

        $revenueChart->labels($labels); //labels (x axis)

        $revenueChart->dataset('Doanh thu', 'line', $values)->color('#32ff7e');//create the dataset to draw the line
        $total = array_sum($values); //how much in total?
        $title = 'Thống kê doanh thu';
        return view('dashboard.revenue', compact('title', 'revenueChart', 'total')); //compact is the short way to do 'title'=>$title
    }

    /**
     * get time range from requested URL
     * @param Request $request
     * @return array
     */
    private function get_time(Request $request): array
    {
        if ($request->has('start')) { //is there start arg in URL?
            $start = $request->get('start'); //then take it
        } else { //no?
            $start = 'today - 6 day'; //then default is 1 week range, so start from 6 days before
        }
        $start = new Carbon($start);


        if ($request->has('end')) {
            $end = $request->get('end');
        } else {
            $end = 'today';//to today
        }

        $end = new Carbon($end);
        $end = $end->addDays(1); // to 29h:59m:59s of today
        $end = $end->addSeconds(-1);

        FlashToOld::flash_to_old($start->format('M d, Y'), 'start'); //save to display selected daterange on date selecting form
        FlashToOld::flash_to_old($end->format('M d, Y'), 'end');
        return array($start, $end); //return the range
    }
}
