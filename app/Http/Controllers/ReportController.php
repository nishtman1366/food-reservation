<?php

namespace App\Http\Controllers;

use App\Exports\FoodReservationExport;
use App\Models\Employment\Unit;
use App\Models\Food;
use App\Models\Order;
use App\Models\Poll;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.reports.list');
    }

    public function view(Request $request)
    {
        $name = $request->route('name');
        switch ($name) {
            case 'Food-Orders':
                $gDate = $request->get('gDate');
                $jDate = $request->get('jDate');
                $type = (int)$request->get('type');
                $data = [];
                $downloadLink = null;
                if (!is_null($gDate)) {
                    $date = Carbon::createFromFormat('Y/m/d', $gDate)->hour(0)->minute(0)->second(0);
                    $foods = Food::orderBy('name', 'ASC')->get();
                    $i = 1;
                    foreach ($foods as $food) {
                        $ordersCount = Order::whereHas('daysFood', function ($query) use ($date, $type, $food) {
                            $query->where('date', $date)->where('type', $type)->whereHas('food', function ($q) use ($food) {
                                $q->where('id', $food->id);
                            });
                        })->count();
                        if ($ordersCount !== 0) {
                            $data[] = [
                                '#' => $i,
                                'name' => $food->name,
                                'count' => $ordersCount
                            ];
                            $i++;
                        }
                    }
                    $fileName = 'Food-Orders.' . str_replace('/', '', $gDate) . '.xlsx';
                    $downloadLink = url('storage/reports') . '/' . $fileName;
                    $headers = ['ردیف', 'نام غذا', 'تعداد سفارش'];
                    Excel::store(new FoodReservationExport(collect($data), $headers), 'reports/' . $fileName, 'public');
                }

                return view('pages.reports.food_reports', [
                    'list' => $data,
                    'gDate' => $gDate,
                    'jDate' => $jDate,
                    'downloadLink' => $downloadLink,
                ]);
                break;
            case 'User-Orders':
                $gDate = $request->get('gDate');
                $jDate = $request->get('jDate');
                $type = $request->get('type');
                $data = [];
                $downloadLink = null;
                if (!is_null($gDate)) {
                    $date = Carbon::createFromFormat('Y/m/d', $gDate)->hour(0)->minute(0)->second(0);
                    $users = User::where('level', 2)->orderBy('id', 'ASC')->get();
                    $i = 1;
                    foreach ($users as $user) {
                        $order = Order::with('daysFood.food')
                            ->where('user_id', $user->id)
                            ->whereHas('daysFood', function ($query) use ($date, $user, $type) {
                                $query->where('date', $date)->where('type', $type);
                            })->get()->first();
                        if (!is_null($order)) {
                            $data[] = [
                                '#' => $i,
                                'name' => $user->last_name . ' ' . $user->first_name,
                                'food' => $order->daysFood->food->name
                            ];
                            $i++;
                        }
                    }
                    $fileName = 'User-Orders.' . str_replace('/', '', $gDate) . '.xlsx';
                    $downloadLink = url('storage/reports') . '/' . $fileName;
                    $headers = ['ردیف', 'نام کارمند', 'نام غذا'];
                    Excel::store(new FoodReservationExport(collect($data), $headers), 'reports/' . $fileName, 'public');
                }

                return view('pages.reports.user_reports', [
                    'list' => $data,
                    'gDate' => $gDate,
                    'jDate' => $jDate,
                    'downloadLink' => $downloadLink,
                ]);
                break;
            case 'Polls':
                $gDate = $request->get('gDate');
                $jDate = $request->get('jDate');
                $count = 0;
                $score =
                $score1 = $score2 = $score3 = $score4 = $score5 = 0;
                if (!is_null($gDate)) {
                    $date = Carbon::createFromFormat('Y/m/d', $gDate)->hour(0)->minute(0)->second(0);
                    $votesQuery = Poll::where('date', $date);
                    $count = $votesQuery->count();
                    $score = $votesQuery->avg('vote');
                    $score1 = Poll::where('date', $date)->where('vote', 1)->count();
                    $score2 = Poll::where('date', $date)->where('vote', 2)->count();
                    $score3 = Poll::where('date', $date)->where('vote', 3)->count();
                    $score4 = Poll::where('date', $date)->where('vote', 4)->count();
                    $score5 = Poll::where('date', $date)->where('vote', 5)->count();
                }
                return view('pages.reports.polls', [
                    'votes' => [
                        $score1,
                        $score2,
                        $score3,
                        $score4,
                        $score5,
                    ],
                    'count' => $count,
                    'score' => round($score, 1),
                    'gDate' => $gDate,
                    'jDate' => $jDate,
                ]);
                break;
            case 'Units-Orders':
                $monthes = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
                $selectedMonth = $request->get('month');
                $type = $request->get('type');
                $data = [];
                $downloadLink = null;
                if (!is_null($selectedMonth)) {
                    $monthFirstDay = \Morilog\Jalali\CalendarUtils::toGregorian(Jalalian::now()->format('Y'), (int)$selectedMonth, 1);
                    $monthLastDay = \Morilog\Jalali\CalendarUtils::toGregorian(Jalalian::now()->format('Y'), (int)$selectedMonth, 30);
                    $date = [
                        $monthFirstDay,
                        $monthLastDay
                    ];
                    $units = Unit::orderBy('name', 'ASC')->get();
                    $i = 1;
                    foreach ($units as $unit) {
                        $ordersCount = Order::whereHas('user', function ($query) use ($unit) {
                            $query->whereHas('unit', function ($q) use ($unit) {
                                $q->where('id', $unit->id);
                            });
                        })->whereHas('daysFood', function ($query) use ($date, $type) {
                            $query->where('date', '>=', sprintf('%s-%s-%s', $date[0][0], $date[0][1], $date[0][2]))
                                ->where('date', '<=', sprintf('%s-%s-%s', $date[1][0], $date[1][1], $date[1][2]));
                        })->count();
                        $data[] = [
                            '#' => $i,
                            'unit' => $unit->name,
                            'ordersCount' => $ordersCount
                        ];
                        $i++;
                    }
                    $fileName = 'Unit-Orders.' . (int)$selectedMonth . '.xlsx';
                    $downloadLink = url('storage/reports') . '/' . $fileName;
                    $headers = ['ردیف', 'نام واحد', 'تعداد سفارش'];
                    Excel::store(new FoodReservationExport(collect($data), $headers), 'reports/' . $fileName, 'public');
                }
                return view('pages.reports.units', [
                    'monthes' => $monthes,
                    'selectedMonth' => $selectedMonth,
                    'list' => $data,
                    'downloadLink' => $downloadLink,
                ]);
                break;
        }
    }
}
