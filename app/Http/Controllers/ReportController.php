<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            case 'Food-orders':
                $gDate = $request->get('gDate');
                $jDate = $request->get('jDate');
                $data = [];
                if (!is_null($gDate)) {
                    $date = Carbon::createFromFormat('Y/m/d', $gDate)->hour(0)->minute(0)->second(0);
                    $foods = Food::orderBy('name', 'ASC')->get();
                    foreach ($foods as $food) {
                        $ordersCount = Order::whereHas('daysFood', function ($query) use ($date, $food) {
                            $query->where('date', $date)->whereHas('food', function ($q) use ($food) {
                                $q->where('id', $food->id);
                            });
                        })->count();
                        $data[] = [
                            'name' => $food->name,
                            'count' => $ordersCount
                        ];
                    }
                }
                return view('pages.reports.food_reports', [
                    'list' => $data,
                    'gDate' => $gDate,
                    'jDate' => $jDate,
                ]);
                break;
            case 'user-orders':

                break;
        }
    }
}
