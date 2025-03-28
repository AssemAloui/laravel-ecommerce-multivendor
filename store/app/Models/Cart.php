<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public $incrementing = false;

    use HasFactory;
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(CartObserver::class);
        // static::creating(function (Cart $cart) {
        //     $cart->id = (string) \Illuminate\Support\Str::uuid();
        // });
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
