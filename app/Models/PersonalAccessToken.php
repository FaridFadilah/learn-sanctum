<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class PersonalAccessToken extends SanctumPersonalAccessToken{
    use HasFactory;
    protected static function boot(){
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}