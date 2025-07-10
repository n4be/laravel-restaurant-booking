<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $restaurants = Restaurant::latest()->get();
        return response()->view('restaurant.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $restaurant = new Restaurant;
        $restaurant->user_id = Auth::id();
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurant_images', 'public');
            $restaurant->image = $imagePath;
        } else {
            $imagePath = 'restaurant_images/comingsoon.webp';
            $restaurant->image = $imagePath;
        }
        $restaurant->save();
        return redirect(route('restaurant.index'))->with('success', '登録が完了しました');
    }

    public function show(Restaurant $restaurant)
    {
        $menu = $restaurant->menu;
        return view('restaurant.show', compact('restaurant', 'menu'));
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();
        return redirect(route('restaurant.index'))->with('success', 'レストランを削除しました');
    }

    public function edit(Restaurant $restaurant)
    {
        return view('restaurant.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $restaurant->name = $request->name;
        $restaurant->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurant_images', 'public');
            $restaurant->image = $imagePath;
        } else {
            $imagePath = 'restaurant_images/comingsoon.webp';
            $restaurant->image = $imagePath;
        }

        $restaurant->save();

        return redirect()->route('restaurant.show', $restaurant)->with('success', 'レストラン情報を更新しました');
    }

    public function reservation($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurant.reservation', compact('restaurant'));
    }


}
