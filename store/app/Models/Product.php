<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    //accessor
    public function getImageUrlAttribute() 
    {

        return 'https://motobros.com/wp-content/uploads/2024/09/no-image.jpeg';
        // if(!$this->image) {
        //     return 'https://motobros.com/wp-content/uploads/2024/09/no-image.jpeg';
        // }
        // if(Str::startsWith($this->image,['http://', 'https://'])) {
        //     return $this->image;
            
        // }
        // return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        if(!$this->compare_price) {
            return 0;
        }
        return round((100 * $this->price / $this->compare_price) -100,1);
        
    }
}
