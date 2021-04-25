<?php
namespace Modules\Core\Entities;

class AdUser extends BaseModelAuth
{
    protected $table = 'ad_user';
    protected $fillable = [
        'username',
        'password',
        'fullname',
        'email',
        'avatar',
        'default_stock_id',
        'status',
    ];
    protected $hidden = ['password'];

    public $timestamps = false;

    public function setAttribute($key, $value)
    {
        if ($key != $this->getRememberTokenName()) {
            parent::setAttribute($key, $value);
        }
    }
}
