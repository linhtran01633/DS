<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sick extends Model
{
    use HasFactory;

    protected $table = "sick";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'date',
        'hours',
        'hours',
        'HA',
        'bloodSugar',
        'circuit',
        'breathing',
        'tall',
        'weight',
        'BMI',
        'symptom',
        'result',
        'result1',
        'result2',
        'result3',
        'result4',
    ];
}
