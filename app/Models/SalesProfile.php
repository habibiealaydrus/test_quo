<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesProfile extends Model
{
    protected $table = 'sales_profile';
    protected $primaryKey = 'spId';
    protected $fillable = [
        'usersId',
        'spGender',
        'spPhone',
        'spNIK',
        'spAddress',
        'spTtdCode'
    ];
    public $timestamps = true;
}
