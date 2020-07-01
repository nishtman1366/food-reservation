<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $foods = Food::orderBy('name', 'ASC')->get();
        return view('pages.foods', compact('foods'));
    }

    public function create(Request $request)
    {

        $file = $request->file('file')->store('foods', 'public');
        $request->merge(['image' => basename($file)]);
        $food = Food::create($request->all());

        return response()->json($food);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $food = Food::find($id);
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete('foods/' . $food->image);
            $file = $request->file('file')->store('foods', 'public');
            $request->merge(['image' => basename($file)]);
        }
        $food->fill($request->all());
        $food->save();
        return response()->json($food);
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');
        $food = Food::find($id);
        Storage::disk('public')->delete('foods/' . $food->image);
        $food->delete();
        return response()->json([]);
    }
}
