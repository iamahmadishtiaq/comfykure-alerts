<?php
namespace AhmadIshtiaq\ComfykureAlerts\Models;
use Illuminate\Database\Eloquent\Model;

class AlertEmail extends Model {
    protected $table = 'alert_emails';
    protected $fillable = ['email', 'is_active'];
}
