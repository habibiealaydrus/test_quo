<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationList extends Model
{
    protected $table = 'quotation_list';
    protected $primaryKey = 'quLiId';
    protected $fillable = [
        'quoId',
        'code',
        'users',
        'item',
        'quantity',
        'price',
        'discount',
        'subtotal',
    ];
    public $timestamps = true;
}
