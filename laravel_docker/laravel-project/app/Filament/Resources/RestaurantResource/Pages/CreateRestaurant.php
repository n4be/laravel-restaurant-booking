<?php

namespace App\Filament\Resources\RestaurantResource\Pages;

use App\Filament\Resources\RestaurantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateRestaurant extends CreateRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // ログインユーザーのIDを代入
        return $data;
    }
}
