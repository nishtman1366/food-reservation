<?php

namespace App\Http\Controllers;

use App\Models\DaysFood;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        if (date('H') > 9) $today->addDay();
        $days = DaysFood::where('date', '>=', $today)->groupBy('date')->get(['date']);
        $list = [];
        foreach ($days as $day) {
            $dayFoods = DaysFood::with('food')->where('date', $day->date)->get();
            $list[] = [
                'date' => $day->date,
                'dateArray' => $day->dateArray,
                'foods' => $dayFoods
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
        $order = Order::where('user_id', Auth::user()->id)->whereHas('daysFood', function ($query) use ($date) {
            $query->where('date', $date);
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
