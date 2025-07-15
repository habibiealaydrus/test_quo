<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'companyId';
    protected $fillable = [
        'companyCode',
        'companyName',
        'companyArea',
        'codeArea',
        'logo',
    ];
    public $timestamps = true;
}
