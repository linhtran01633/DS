<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    use HasFactory;

    protected $table = "image_products";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'product_id',
        'file_name',
        'path',
    ];

    public function Product()
    {
        return $this->belongsTo(\App\Models\Product::class,'product_id','id');
    }
}
