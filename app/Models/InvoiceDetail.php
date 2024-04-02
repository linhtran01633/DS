<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = "invoice_details";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'invoice_id',
        'product_id',
        'amount',
        'quanty',
        'delete_flag'
    ];

    public function Product()
    {
        return $this->hasOne(\App\Models\Product::class,'id','product_id');
    }
}
