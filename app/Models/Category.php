<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categorys";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'name',
        'delete_flag',
    ];

    public function Product()
    {
        return $this->hasMany(\App\Models\Product::class,'category_id','id');
    }
}
