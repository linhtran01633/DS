<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    use HasFactory;
    protected $table = "prescription_detail";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'id',
        'id_drug',
        'number_0f_day',
        'every_day',
        'every_times',
        'quantity',
        'price',
        'dosage',
        'id_usage',
        'session',
        'every_day',
        'note',
        'user_create',
        'id_prescription',
    ];


    public function Drug()
    {
        return $this->hasOne(\App\Models\Drug::class,'id','id_drug');
    }

    public function Usage()
    {
        return $this->hasOne(\App\Models\Usage::class,'id','id_usage');
    }

}
