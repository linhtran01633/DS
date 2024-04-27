<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = "patient";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'sex',
        'job',
        'name',
        'date',
        'phone',
        'status',
        'ethnic',
        'address',
        'workshop',
    ];
}
