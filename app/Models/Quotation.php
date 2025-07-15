<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotation';
    protected $primaryKey = 'quotationId';
    protected $fillable = [
        'quoSlug',
        'quoCode',
        'quoCompany',
        'quoProject',
        'quoPIC',
        'quoContact',
        'quoEmail',
        'quoTotal',
        'quoPeriodNote',
        'quoPpnNote',
        'quoTopNote',
        'quoDeliveryNote',
        'quoStockNote',
        'quoStatus',
        'usersId',
        'compsId',
    ];
    public $timestamps = true;
}
