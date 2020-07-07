<?php

namespace App\Http\Controllers;

use App\Exports\FoodReservationExport;
use App\Models\Food;
use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.reports.list');
    }

    public function view(Request $request)
    {
        $name = $request->route('name');
        switch ($name) {
            case 'Food-Orders':
                $gDate = $request->get('gDate');
                $jDate = $request->get('jDate');
                $type = (int)$request->get('type');
                $data = [];
                $downloadLink = null;
                if (!is_null($gDate)) {
                    $date = Carbon::createFromFormat('Y/m/d', $gDate)->hour(0)->minute(0)->second(0);
                    $foods = Food::orderBy('name', 'ASC')->get();
                    $i = 1;
                    foreach ($foods as $food) {
                        $ordersCount = Order::whereHas('daysFood', function ($query) use ($date, $type, $food) {
                            $query->where('date', $date)->where('type', $type)->whereHas('food', function ($q) use ($food) {
                                $q->where('id', $food->id);
                            });
                        })->count();
                        if ($ordersCount !== 0) {
                            $data[] = [
                                '#' => $i,
                                'name' => $food->name,
                                'count' => $ordersCount
                            ];
                            $i++;
                        }
                    }
                    $fileName = 'Food-Orders.' . str_replace('/', '', $gDate) . '.xlsx';
                    $downloadLink = url('storage/reports') . '/' . $fileName;
                    $headers = ['ردیف', 'نام غذا', 'تعداد سفارش'];
                    Excel::store(new FoodReservationExport(collect($data), $headers), 'reports/' . $fileName, 'public');
                }

                return view('pages.reports.food_reports', [
                    'list' => $data,
                    'gDate' => $gDate,
                    'jDate' => $jDate,
                    'downloadLink' => $downloadLink,
                ]);
                break;
            case 'User-Orders':
                $gDate = $request->get('gDate');
                $jDate = $request->get('jDate');
                $type = $request->get('type');
                $data = [];
                $downloadLink = null;
                if (!is_null($gDate)) {
                    $date = Carbon::createFromFormat('Y/m/d', $gDate)->hour(0)->minute(0)->second(0);
                    $users = User::where('level', 2)->orderBy('id', 'ASC')->get();
                    $i = 1;
                    foreach ($users as $user) {
                        $order = Order::with('daysFood.food')
                            ->where('user_id', $user->id)
                            ->whereHas('daysFood', function ($query) use ($date, $user, $type) {
                                $query->where('date', $date)->where('type', $type);
                            })->get()->first();
                        if (!is_null($order)) {
                            $data[] = [
                                '#' => $i,
                                'name' => $user->name,
                                'food' => $order->daysFood->food->name
                            ];
                            $i++;
                        }
                    }
                    $fileName = 'User-Orders.' . str_replace('/', '', $gDate) . '.xlsx';
                    $downloadLink = url('storage/reports') . '/' . $fileName;
                    $headers = ['ردیف', 'نام کارمند', 'نام غذا'];
                    Excel::store(new FoodReservationExport(collect($data), $headers), 'reports/' . $fileName, 'public');
                }

                return view('pages.reports.user_reports', [
                    'list' => $data,
                    'gDate' => $gDate,
                    'jDate' => $jDate,
                    'downloadLink' => $downloadLink,
                ]);
                break;
        }
    }
}
