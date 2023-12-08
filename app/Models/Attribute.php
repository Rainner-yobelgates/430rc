<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color_id',
        'size',
        'order',
        'status',
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
