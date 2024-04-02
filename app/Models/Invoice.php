<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoices";
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'date',
        'name_from',
        'phone_from',
        'email_from',
        'name_to',
        'phone_to',
        'name_city',
        'name_district',
        'name_ward',
        'address_to',
        'note_to',
        'amount',
        'user_id',
        'delete_flag',
    ];

    public function InvoiceDetail()
    {
        return $this->hasMany(\App\Models\InvoiceDetail::class,'invoice_id','id');
    }
}
