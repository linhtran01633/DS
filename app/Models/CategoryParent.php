<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryParent extends Model
{
    use HasFactory;
    protected $table = "category_parents";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'name',
        'delete_flag',
    ];

    public function Category()
    {
        return $this->hasMany(\App\Models\Category::class,'category_parent_id','id');
    }
}
