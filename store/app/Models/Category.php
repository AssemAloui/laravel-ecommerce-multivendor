<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "parent_id",
        "description",
        "image",
        "status",
        "slug"
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withdefault([
            'name' => '-'
        ]
        );
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where("status", "=", "active");
    }

    public function scopeStatus(Builder $builder, $status)
    {
        return $builder->where("status", '=', $status);
    }

    public function scopeFilter(Builder $builder, $filter)
    {

        $builder->when($filter['name'] ?? false, function ($builder, $value) {
            $builder->where(
                "categories.name",
                "like",
                "%{$value}%"
            );
        });

        $builder->when($filter['status'] ?? false, function ($builder, $value) {
            $builder->where(
                "categories.status",
                "=",
                $value
            );
        });
    }

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
            ],
            'parent_id' => [
                'nullable',
                'int',
                'exists:categories,id'
            ],
            'image' => [
                'image',
                'mimes:jpg,jpeg,png,gif,svg',
                'max:1048576'
            ],
            'status' => 'required|in:active,archived',
        ];
    }
}
