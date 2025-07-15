<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'users_profile';
    protected $primaryKey = 'upId';
    protected $fillable = [
        'usersId',
        'upGender',
        'upPhone',
        'upNIK',
        'upAddress',
    ];
    public $timestamps = true;
}
