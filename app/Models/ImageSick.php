<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSick extends Model
{
    use HasFactory;

    protected $table = "image_sick";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'sick_id',
        'file_name',
        'path',
    ];
}
