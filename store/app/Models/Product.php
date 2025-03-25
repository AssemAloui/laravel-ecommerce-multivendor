<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'price',
        'category_id',
        'store_id',
        'compare_price',
        'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope("store", new StoreScope());
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Product::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class, // Related Model
            'product_tag', // Pivot table name
            'product_id', // FK in pivot table for the current model
            'tag_id', // FK in pivot table for the related model
            'id', // PK current model
            'id' // PK related model
        );
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');    
    }
}
