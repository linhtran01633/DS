<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $table = "prescription";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'id_sick',
        'on_leave',
    ];

    public function PrescriptionDetail()
    {
        return $this->hasMany(\App\Models\PrescriptionDetail::class,'id_prescription','id');
    }
}
