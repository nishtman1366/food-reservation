<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::orderBy('name', 'ASC')->get();
        return view('pages.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $items = $request->all();

        foreach ($items as $key => $item) {
            Setting::where('key', $key)->update(['value' => $item]);
        }

        return redirect()->route('settings.main');
    }
}
