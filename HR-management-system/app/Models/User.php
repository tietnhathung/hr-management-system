<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = 'users';
    protected $fillable = [
        "id","username","name",'fullname','email','email_verified_at','password','avatar','remember_token','created_at','updated_at','company_id','status','position','address','mobile','deleted_at','type','accesstoken_app','app' , 'firebase_token','is_notifications','default_monitor_id','created_by','deleted_by','updated_by','section_id'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function UserDevice()
    {
        return $this->hasMany(UserDevice::class, 'user_id', 'id');
    }

    public function Device()
    {
        return $this->belongsToMany(Device::class,'user_device' ,"user_id","device_id");
    }

    public function delete()
    {
        $this->UserDevice()->delete();
        return parent::delete();
    }
}
