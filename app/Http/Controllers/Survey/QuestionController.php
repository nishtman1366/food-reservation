<?php

namespace App\Http\Controllers\Survey;

use App\Http\Controllers\Controller;
use App\Models\Survey\Answer;
use App\Models\Survey\Question;
use App\Models\Survey\UsersAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::with('answers')->orderBy('id', 'DESC')->get()->each(function ($question) {
            $answers = $question->answers->pluck('id');
            $answersCount = UsersAnswer::whereIn('answer_id', $answers)->count();
            $question->usersAnswersCount = $answersCount;
        });

        return view('pages.survey.questions', compact('questions'));
    }

    public function create(Request $request)
    {
        return view('pages.survey.questionsForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $question = Question::create($request->all());
        $answers = $request->get('answers', []);
        foreach ($answers as $answer) {
            if (!is_null($answer)) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $answer
                ]);
            }
        }
        return redirect()->route('surveys.questions.list');
    }

    public function view(Request $request)
    {
        $id = (int)$request->route('id');
        $question = Question::with('answers')->find($id);

        return view('pages.survey.editQuestionsForm', compact('question'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $id = (int)$request->route('id');
        $question = Question::find($id);

        if (is_null($question)) throw new NotFoundHttpException('سوال مورد نظر یافت نشد');
        $question->fill($request->all());
        $question->save();
        $answers = $request->get('answers', []);
        foreach ($answers as $key => $answer) {
            if (!is_null($answer)) {
                $a = Answer::find((int)$key);
                if (!is_null($a)) {
                    $a->update(['answer' => $answer]);
                }
            }
        }

        $deleteAnswers = $request->get('delete_answers', []);
        foreach ($deleteAnswers as $answerId) {
            Answer::destroy((int)$answerId);
        }

        $newAnswers = $request->get('new_answers', []);
        foreach ($newAnswers as $newAnswer) {
            if (!is_null($newAnswer)) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $newAnswer
                ]);
            }
        }

        return redirect()->route('surveys.questions.list');
    }

    public function destroy(Request $request)
    {
        $id = (int)$request->route('id');
        Question::destroy($id);

        return redirect()->route('surveys.questions.list');
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $questions = $request->get('questions', []);

        if(count($questions) > 0) {
            foreach ($questions as $question) {
                UsersAnswer::create([
                    'answer_id' => $question,
                    'user_id' => $user->id
                ]);
            }

            return redirect()->route('dashboard')->withInput(['surveys' => 'ثبت رای با موفقیت انجام شد.']);
        }else{
            return redirect()->route('dashboard')->withInput(['surveys' => 'لطفا یکی از گزینه ها را انتخاب نمایید']);
        }
    }

    public function stats(Request $request)
    {
        $id = (int)$request->route('id');
        $question = Question::with('answers')
            ->with('answers.userAnswers')
            ->find($id);

        if (is_null($question)) throw new NotFoundHttpException('سوال مورد نظر یافت نشد');
        $count = 0;
        $i = 0;
        $chartData = collect([
            'labels'=>collect([]),
            'data'=>collect([]),
        ]);
        foreach ($question->answers as $answer) {
            $chartData['labels']->push($answer->answer);
            $chartData['data']->push(count($answer->userAnswers));
            $count += count($answer->userAnswers);
            $i++;
        }
        return view('pages.survey.stats', compact('question', 'count', 'chartData'));
    }
}
