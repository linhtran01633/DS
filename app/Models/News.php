<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'title',
        'short_description',
        'detailed_description',
        'delete_flag',
    ];
}
