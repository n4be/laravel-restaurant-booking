<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;

class MenuController extends Controller
{
    public function create (Restaurant $restaurant) {
        return view('restaurant.menu.create', compact('restaurant'));
    }

    public function store (Request $request, Restaurant $restaurant) {
        $menu = New Menu();

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
}
