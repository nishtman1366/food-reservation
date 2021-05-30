<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Survey\Answer;
use App\Models\Survey\Question;
use App\Models\Survey\UsersAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
//        $yesterday = Carbon::yesterday();
        $user = Auth::user();
//        $jYesterday = Jalalian::forge($yesterday)->format('Y/m/d');
//        $poll = Poll::where('date', $yesterday)
//            ->where('user_id', $user->id)
//            ->exists();

        $questions = Question::with('answers')
            ->where('status', true)
            ->get()
            ->each(function ($question) use ($user) {
                $answers = Answer::where('question_id', $question->id)->pluck('id');
                $userAnswers = UsersAnswer::where('user_id', $user->id)->whereIn('answer_id', $answers)->exists();
                $question->voted = $userAnswers;
            });

        return view('pages.home', ['questions' => $questions]);
    }

    public function login(Request $request)
    {
        $popups = PopupController::getPopupList();
        return view('pages.login', compact('popups'));
    }

    public function signIn(Request $request)
    {
//        dd($request->all());
        $remember = $request->get('remember', false);
        if (Auth::attempt($request->only(['username', 'password']), $remember)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
