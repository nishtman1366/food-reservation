<?php

namespace App\Http\Controllers;

use App\Models\Reservations\Conference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ConferenceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $reservations = Conference::with('user')
            ->where(function ($query) use ($user) {
                if ($user->level != 1) {
                    $query->where('user_id', $user->id);
                }
            })
            ->orderBy('id', 'DESC')->paginate(20);
        return view('pages.reservations.list', compact('reservations'));
    }

    public function create(Request $request)
    {
        $types = [
            ['id' => 'conference', 'name' => 'اتاق جلسه'],
            ['id' => 'guest', 'name' => 'ورود میهمان']
        ];
        $cateringTypes = [
            ['id' => 'type_01', 'name' => 'درجه ۱'],
            ['id' => 'type_02', 'name' => 'درجه ۲'],
            ['id' => 'type_03', 'name' => 'درجه ۳']
        ];

        return view('pages.reservations.create', compact('types', 'cateringTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'type' => 'required',
            'count' => 'required',
            'catering_type' => 'required',
            'date' => 'required',
            'duration' => 'required',
        ],
            [
                'subject.required' => 'نوشتن موضوع رزرو الزامیست',
                'type.required' => 'انتخاب نوع رزرو الزامیست',
                'count.required' => 'نوشتن تعداد میهمان الزامیست',
                'catering_type.required' => 'انتخاب نوع پذیرایی الزامیست',
                'date.required' => 'نوشتن زمان رزرو الزامیست',
                'duration.required' => 'نوشتن مدت رزرو الزامیست',
            ]);
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);

        Conference::create($request->all());

        return redirect()->back()->withInput(['message' => 'ok']);
    }

    public function view(Request $request)
    {
        $id = (int)$request->route('id');
        $types = [
            ['id' => 'conference', 'name' => 'اتاق جلسه'],
            ['id' => 'guest', 'name' => 'ورود میهمان']
        ];
        $cateringTypes = [
            ['id' => 'type_01', 'name' => 'درجه ۱'],
            ['id' => 'type_02', 'name' => 'درجه ۲'],
            ['id' => 'type_03', 'name' => 'درجه ۳']
        ];
        $statues = [
            ['id' => 0, 'name' => 'ثبت شده'],
            ['id' => 1, 'name' => 'تایید شده'],
            ['id' => 2, 'name' => 'رد شده'],
            ['id' => 3, 'name' => 'انجام شده']
        ];
        $reservation = Conference::with('user')
            ->with('user.unit')
            ->find($id);
        if (is_null($reservation)) throw new NotFoundHttpException('اطلاعات رزرو یافت نشد.');

        return view('pages.reservations.edit', compact('reservation', 'types', 'cateringTypes', 'statues'));
    }

    public function update(Request $request)
    {
        $id = (int)$request->route('id');

        $reservation = Conference::find($id);
        if (is_null($reservation)) throw new NotFoundHttpException('اطلاعات رزرو یافت نشد.');

        $reservation->fill($request->all());
        $reservation->save();

        return redirect()->route('reservations.list')->withInput(['message' => 'ویرایش رزرواسیون با موفقیت انجام شد.']);
    }

    public function destroy(Request $request)
    {
        $id = (int)$request->route('id');

        $reservation = Conference::find($id);
        if (is_null($reservation)) throw new NotFoundHttpException('اطلاعات رزرو یافت نشد.');

        $reservation->delete();

        return redirect()->back()->withInput(['message' => 'حذف رزرواسیون با موفقیت انجام شد.']);
    }
}
