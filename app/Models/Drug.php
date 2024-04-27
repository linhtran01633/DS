<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $table = "drug";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'name',
        'status',
        'id_generic',
        'id_drug_unit',
        'price',
    ];

    public function Generic()
    {
        return $this->belongsTo(\App\Models\Generic::class,'id_generic','id');
    }

    public function DrugUnit()
    {
        return $this->belongsTo(\App\Models\DrugUnit::class,'id_drug_unit','id');
    }
}
