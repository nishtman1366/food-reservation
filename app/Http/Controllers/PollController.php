<?php

namespace App\Http\Controllers;

use App\Models\DaysFood;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $yesterday = Carbon::yesterday()->addDay();
        $dayFood = DaysFood::where('date', $yesterday)->exists();
        if (!$dayFood) return response()->json('در تاریخ ارسال شده غذا ارائه نشده است', 500);

        $date = $yesterday->hour(0)->minute(0)->second(0);;
        $vote = $request->get('vote');
        Poll::create([
            'user_id' => $user->id,
            'date' => $date,
            'vote' => $vote
        ]);
    }
}
