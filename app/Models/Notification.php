<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    
    protected $table = 'notification';
    protected $primaryKey = 'notification_id';
    protected $fillable = [
        'usersId',
        'compsId',
        'rolesId',
        'quotId',
        'title',
        'content',
        'follup_url',
    ];
    public $timestamps = true;

    protected $dates = [
        'created_at',
    ];

    public function getCreatedFormatAttribute()
    {  
        return $this->created_at->format('d-m-Y H:i:s');
    }
  protected $appends = ['created_format'];
  public function reads()
    {
        return $this->hasMany(NotificationRead::class, 'notification_id');
    }
}
