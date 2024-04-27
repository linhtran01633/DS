<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generic extends Model
{
    use HasFactory;

    protected $table = "generic";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'name',
        'status',
    ];
}
