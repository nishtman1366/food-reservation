<?php

namespace App\Http\Controllers;

use App\Models\DaysFood;
use App\Models\Order;
use App\Setting;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::where('key', 'ALLOW_ORDER_ALL_TIME')->get()->first();
        if($settings->value==1){
            $today = Carbon::today();
        }else{
            $today = Carbon::today()->addDay();
        }

        if (date('H') > 16) $today->addDay();
        $days = DaysFood::where('date', '>=', $today)->groupBy('date')->get(['date']);
        $list = [];
        foreach ($days as $day) {
            $lunchFoods = DaysFood::with('food')->where('type', 1)->where('date', $day->date)->get();
            $dinnerFoods = DaysFood::with('food')->where('type', 2)->where('date', $day->date)->get();
            $list[] = [
                'date' => $day->date,
                'dateArray' => $day->dateArray,
                'lunchFoods' => $lunchFoods,
                'dinnerFoods' => $dinnerFoods
            ];
        }
        $orders = Order::where('user_id', Auth::user()->id)->whereHas('daysFood', function ($query) use ($today) {
            $query->where('date', '>=', $today);
        })->get();
        return view('pages.orders', ['dayFoods' => $list, 'orders' => $orders]);
    }

    public function create(Request $request)
    {
        $date = $request->get('date');
        $foodId = $request->get('foodId');
        $type = (int)$request->get('type');
        $order = Order::where('user_id', Auth::user()->id)
            ->whereHas('daysFood', function ($query) use ($date, $type) {
                $query->where('date', $date)->where('type', $type);
            })->get()->first();

        if ($foodId == -1) {
            if (!is_null($order)) $order->delete();
        } else {
            if (is_null($order)) {
                Order::create([
                    'user_id' => Auth::User()->id,
                    'days_food_id' => $foodId
                ]);
            } else {
                $order->update(['days_food_id' => $foodId]);
            }
        }

        return response()->json();
    }
}
