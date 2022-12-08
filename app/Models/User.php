<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [''];

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
    ];

    public function address()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'id_user');
    }

    public function cartStore()
    {
        return $this->hasMany(Cart::class, 'id_user')->groupBy('id_store')->orderBy('created_at', 'desc')->get();
    }

    public function cartStoreActive()
    {
        return $this->hasMany(Cart::class, 'id_user')->where('status', '1')->groupBy('id_store')->orderBy('created_at', 'desc')->get();
    }

    public function comment()
    {
        return $this->hasMany(CommentProduct::class, 'create_by');
    }
}
