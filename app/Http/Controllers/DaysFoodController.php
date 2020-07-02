<?php

namespace App\Http\Controllers;

use App\Models\DaysFood;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class DaysFoodController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $days = DaysFood::where('date', '>=', $today)->groupBy('date')->get(['date']);
        $list = [];
        foreach ($days as $day) {
            $dayFoods = DaysFood::with('food')->where('date', $day->date)->get();
            $ids = [];
            foreach ($dayFoods as $food) {
                $ids[] = (string)$food->food_id;
            }
            $list[] = [
                'date' => $day->jDate,
                'weekday' => $day->weekday,
                'ids' => json_encode($ids),
                'foods' => $dayFoods
            ];
        }
        $foods = Food::orderBy('name', 'ASC')->get();
        return view('pages.days_foods', ['foods' => $foods, 'dayFoods' => $list]);
    }

    public function create(Request $request)
    {
        $jDate = explode('/', $request->get('date'));
        $date = (new Jalalian($jDate[0], $jDate[1], $jDate[2]))->toCarbon();
        foreach ($request->get('foodsList') as $food) {
            DaysFood::create([
                'date' => $date,
                'food_id' => $food['id']
            ]);
        }
        return response()->json();
    }

    public function update(Request $request)
    {
        return response()->json($request->all());
    }
}
