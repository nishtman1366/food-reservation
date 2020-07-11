<?php

namespace App\Http\Controllers;

use App\Models\Employment\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $units = Unit::withCount('users')->orderBy('id', 'ASC')->get();

        return view('pages.units', compact('units'));
    }

    public function create(Request $request)
    {
        Unit::create($request->all());

        return response()->json([]);
    }

    public function view(Request $request)
    {
        $id = $request->route('id');
        $unit = Unit::find($id);

        return response()->json($unit);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $unit = Unit::find($id);
        $unit->fill($request->all());
        $unit->save();

        return response()->json($unit);
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');
        $unit = Unit::destroy($id);

        return response()->json($unit);
    }
}
