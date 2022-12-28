<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * fungsi yang dijalankan ketika model dibuat
     * ketika data akan disave ke DB
     * @return void
     */
    protected static function boot(){
        parent::boot();

       /**
        * fungsi yang dijalankan ketika model dibuat
        * ketika data akan disave ke DB
        * @return void
        */
        static::creating(function($user){
            $hash = Hash::make($user->password);
            $user->password = $hash;
        });

        /**
        * fungsi yang dijalankan ketika model dibuat
        * ketika data akan disave ke DB
        * @return void
        */
        self::updating(function($user){
            if($user->isDirty(['password'])){
                $hash = Hash::make($user->password);
                $user->password = $hash;
            }
        });
    } 
}