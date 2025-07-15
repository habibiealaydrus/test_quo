<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'rolesId';
    protected $fillable = [
        'rolesName',
        'developer',
        'superAdmin',
        'generalManager',
        'administrator',
        'salesManager',
        'salesSupervisor',
        'salesEngineer',
    ];
    public $timestamps = false;

}
