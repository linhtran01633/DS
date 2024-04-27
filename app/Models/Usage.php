<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;

    protected $table = "usage";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'name',
        'status',
    ];
}
