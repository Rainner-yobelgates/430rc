<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slugs',
        'price',
        'image',
        'category',
        'description',
        'weight',
        'order',
        'status',
    ];
    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
}
