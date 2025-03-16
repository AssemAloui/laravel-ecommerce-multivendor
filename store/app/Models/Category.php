<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "parent_id", "description","image","status","slug"
        ];

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
