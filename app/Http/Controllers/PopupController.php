<?php

namespace App\Http\Controllers;

use App\Models\Admin\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopupController extends Controller
{
    public function index(Request $request)
    {
        $popups = Popup::orderBy('id', 'DESC')->get();
        $now = \Carbon\Carbon::now();
        $popups->each(function ($popup) use ($now) {
            if ($now->gt($popup->start) && $now->lt($popup->end)) {
                $popup->status = 'در حال نمایش';
            } else {
                $popup->status = 'به پایان رسیده';
            }

        });
        return view('pages.popups', compact('popups'));
    }

    public function create(Request $request)
    {
        Popup::create($request->all());
        return response()->json();
    }

    public function view(Request $request)
    {
        $id = $request->route('id');
        $popup = Popup::find($id);

        return response()->json($popup);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $popup = Popup::find($id);
        $popup->fill($request->all());
        $popup->save();
        return response()->json();
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');
        Popup::destroy($id);
        return response()->json();
    }

    public static function getPopupList()
    {
        $now = \Carbon\Carbon::now();
        $popups = Popup::where('start', '<', $now)
            ->where('end', '>', $now)
            ->orderBy('id', 'ASC')->get();
        return $popups;
    }
}
