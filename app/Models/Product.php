<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    public $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'category_id',
        'brand',
        'name',
        'price',
        'quantity',
        'image',
        'title',
        'title_detail',
        'delete_flag',
    ];

    public function Category()
    {
        return $this->belongsTo(\App\Models\Category::class,'category_id','id');
    }

    public function productImg()
    {
        return $this->hasMany(\App\Models\ImageProduct::class,'product_id','id');
    }
}
