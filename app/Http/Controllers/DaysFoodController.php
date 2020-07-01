<?php

namespace App\Http\Controllers;

use App\Models\DaysFood;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DaysFoodController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $daysFood = DaysFood::where('date', '>=', $today)->get();
        $foods = Food::orderBy('name', 'ASC')->get();
        return view('pages.days_foods', compact('daysFood', 'foods'));
    }
}
