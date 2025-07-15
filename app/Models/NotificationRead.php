<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRead extends Model
{
    protected $fillable = ['notification_id', 'user_id', 'read_at'];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function notification() {
        return $this->belongsTo(Notification::class);
    }
}
