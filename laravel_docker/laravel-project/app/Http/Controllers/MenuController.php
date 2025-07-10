<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;

class MenuController extends Controller
{
    public function create(Restaurant $restaurant)
    {
        return view('restaurant.menu.create', compact('restaurant'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $menu = new Menu();

        // バリデーション
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
        ]);
        // 入力
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->restaurant_id = $restaurant->id;

        $menu->save();

        return redirect()->route('restaurant.show', $restaurant)->with("success", "メニューを登録しました");
    }

    public function edit(Restaurant $restaurant, Menu $menu)
    {
        return view('restaurant.menu.edit', compact('restaurant', 'menu'));
    }

    public function update(Request $request, Restaurant $restaurant,Menu $menu)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
        ]);

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->restaurant_id = $restaurant->id;

        $menu->save();

        return redirect()->route('restaurant.show', [$restaurant, $menu])->with("success", "メニューを更新しました");

    }
}
