<?php

namespace App\Http\Middleware;

use App\Http\Controllers\PopupController;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\View;
use Morilog\Jalali\Jalalian;

class ShareDataToViews
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $gDate = Carbon::now()->format('l d F Y');
        $jDate = Jalalian::forge(Carbon::now())->format('l d F Y');

        $data = [
            'date' => [
                'gDate' => $gDate,
                'jDate' => ta_persian_num($jDate),
            ]
        ];
        $route = $request->route()->getName();
//        $popups = [];
//        $popupVisited = false;
//
//
//        if (!$popupVisited) {
        $popups = PopupController::getPopupList();
//
//        }
        View::share('data', $data);
        View::share('popups', $popups);

        return $next($request);
    }
}
