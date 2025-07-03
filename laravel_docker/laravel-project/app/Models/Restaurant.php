<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    // 予約とのリレーションを追加（必要なら）
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function menus(): HasMany
{
    return $this->hasMany(Menu::class);
}
}
