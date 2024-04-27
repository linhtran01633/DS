<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugUnit extends Model
{
    use HasFactory;
    protected $table = "drug_unit";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'name',
        'status',
    ];
}
