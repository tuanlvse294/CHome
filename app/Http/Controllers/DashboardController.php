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

        list($start, $end) = $this->get_time($request);

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


        return view('dashboard.index', ['title' => 'Thống kê', 'generalChart' => $generalChart, 'browsersChart' => $browsersChart, 'userTypesChart' => $userTypesChart]);
    }


    private static function getYears(Carbon $start, Carbon $end)
    {
        $years = $end->diffInYears($start);
        $result = collect();

        $log = new Log();
        $list = collect($log->getFillable())->except('date');
        for ($i = 0; $i <= $years; $i++) {
            $nextYear = $start->copy();
            $nextYear->addYear(1);
            $item = collect();
            $logs = Log::query()->whereBetween('date', [$start->timestamp, $nextYear->timestamp])->get();
            foreach ($list as $key) {
                $item[$key] = $logs->pluck($key)->sum();
            }
            $item->label = $start->year;
            $result[$i] = $item;
            $start = $nextYear;
        }
        return $result;
    }

    private static function getMonths(Carbon $start, Carbon $end)
    {
        $months = $end->diffInMonths($start);

        $result = collect();

        $log = new Log();
        $list = collect($log->getFillable())->except('date');
        for ($i = 0; $i <= $months; $i++) {
            $nextMonth = $start->copy();
            $nextMonth->addMonth(1);
            $item = collect();
            $logs = Log::query()->whereBetween('date', [$start->timestamp, $nextMonth->timestamp])->get();
            foreach ($list as $key) {
                $item[$key] = $logs->pluck($key)->sum();
            }
            $item->label = $start->year . '/' . $start->month;
            $result[$i] = $item;
            $start = $nextMonth;
        }
        return $result;
    }

    private function getDays(Carbon $start, Carbon $end)
    {
        $days = $end->diffInDays($start);

        $result = collect();

        for ($i = 0; $i <= $days; $i++) {
            $result[$i] = Log::firstOrNew(['date' => $start->timestamp]);
            $result[$i]->label = $start->toDateString();
            $start->addDay(1);
        }
        return $result;
    }

    public function revenue(Request $request)
    {
        list($start, $end) = $this->get_time($request);

        $period = Period::create($start, $end);
        $totalVisitorsAndPageViews = \Analytics::fetchTotalVisitorsAndPageViews($period);

        $revenueChart = new Chart;
        $revenueChart->title("Thống kê doanh thu", 40);
        $revenueChart->labels($totalVisitorsAndPageViews->pluck('date')->map(function ($item, $key) {
            return $item->format('d/m/y');
        }));

        $revenueChart->dataset('Số khách', 'line', $totalVisitorsAndPageViews->pluck('visitors'))->color('#32ff7e');

        return view('dashboard.index', ['title' => 'Thống kê doanh thu', 'revenueChart' => $revenueChart]);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function get_time(Request $request): array
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
        $end = $end->addDays(1);
        $end = $end->addSeconds(-1);

        FlashToOld::flash_to_old($start->format('M d, Y'), 'start');
        FlashToOld::flash_to_old($end->format('M d, Y'), 'end');
        return array($start, $end);
    }
}
