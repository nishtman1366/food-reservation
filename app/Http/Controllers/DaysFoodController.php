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
        $today = Carbon::today()->addDay();
        $days = DaysFood::where('date', '>=', $today)->groupBy('date')->get(['date']);
        $list = [];
        foreach ($days as $day) {
            $dayFoodsLunch = DaysFood::with('food')->where('date', $day->date)->where('type', 1)->get();
            $dayFoodsDinner = DaysFood::with('food')->where('date', $day->date)->where('type', 2)->get();

            $lunchIds = [];
            foreach ($dayFoodsLunch as $lunches) {
                $lunchIds[] = (string)$lunches->food_id;
            }
            $dinnerIds = [];
            foreach ($dayFoodsDinner as $dinner) {
                $dinnerIds[] = (string)$dinner->food_id;
            }
            $list[] = [
                'jDate' => $day->jDate,
                'gDate' => Carbon::create($day->date)->format('Y/m/d'),
                'weekday' => $day->weekday,
                'lunchIds' => json_encode($lunchIds),
                'dinnerIds' => json_encode($dinnerIds),
                'lunch' => $dayFoodsLunch,
                'dinner' => $dayFoodsDinner,
            ];
        }
        $foods = Food::orderBy('name', 'ASC')->get();
        return view('pages.days_foods', ['foods' => $foods, 'dayFoods' => $list]);
    }

    public function create(Request $request)
    {
        $gDate = $request->get('gDate');
        $type = (int)$request->get('type');
        $date = \Carbon\Carbon::createFromFormat('Y/m/d', $gDate)->hour(0)->minute(0)->second(0);
        foreach ($request->get('foodsList') as $food) {
            DaysFood::create([
                'date' => $date,
                'type' => $type,
                'food_id' => $food['id']
            ]);
        }
        return response()->json();
    }

    public function update(Request $request)
    {
        $gDate = $request->get('gDate');
        $date = \Carbon\Carbon::createFromFormat('Y/m/d', $gDate)
            ->hour(0)
            ->minute(0)
            ->second(0);
        $type = $request->get('type');
        $foods = DaysFood::where('date', $date)->where('type', $type)->get();
        $newMenu = $request->get('foodsList');
        $idsList = [];
        foreach ($newMenu as $item) {
            $idsList[] = $item['id'];
        }
        foreach ($foods as $food) {
            $stay = array_search($food->food_id, $idsList);
            if ($stay === false) $food->delete();
        }
        foreach ($newMenu as $food) {
            DaysFood::firstOrCreate([
                'date' => $date,
                'type' => $type,
                'food_id' => $food['id']
            ]);
        }
        return response()->json();
    }

    public function delete(Request $request)
    {
        $jDate = explode('-', $request->route('date'));
        $date = (new Jalalian($jDate[0], $jDate[1], $jDate[2]))->toCarbon();
        DaysFood::where('date', $date)->delete();

        return response()->json();
    }
}
