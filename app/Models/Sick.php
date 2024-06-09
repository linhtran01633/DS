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
        'id_patient',
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

    public function Patient()
    {
        return $this->hasOne(\App\Models\Patient::class,'id','id_patient');
    }

    public function Prescription()
    {
        return $this->hasOne(\App\Models\Prescription::class,'id_sick','id');
    }

    public function SickImg()
    {
        return $this->hasMany(\App\Models\ImageSick::class,'sick_id','id');
    }
}
