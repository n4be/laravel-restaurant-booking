<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $restaurants = Restaurant::orderBy('created_at', 'desc')->get();
        return response()->view('restaurant.index', compact('restaurants')); // 最新順に表示
    }

    public function create()
    {
        return view('restaurant.create');
    }

    public function store(Request $request)
    {
        Log::debug('storeメソッド開始'); // ログ出力

        // $user_id = Auth::id();
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
            $restaurant->image = $imagePath; // 保存した画像パスを保存
        }


        Log::debug('保存前: ', $restaurant->toArray());

        $restaurant->save();

        $result = $restaurant->save();
        Log::debug('保存結果: ' . ($result ? '成功' : '失敗'));
        Log::debug('画像パス: ' . $imagePath ); // => storage/app/public/images/xxx.jpg になるはず

        return redirect(route('restaurant.create'))->with('success', '登録が完了しました');
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurant.show', compact('restaurant'));
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();
        return redirect(route('restaurant.index'));
    }

    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurant.edit', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $restaurant = Restaurant::find($id);
        $restaurant->user_id = Auth::id();
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;

        dd($restaurant);
        $restaurant->save();
dd();
        return redirect()->route('restaurant.show', ['id' => $id])->with('success', '商品を更新しました');
    }

    public function reservation($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurant.reservation', compact('restaurant'));
    }


}
