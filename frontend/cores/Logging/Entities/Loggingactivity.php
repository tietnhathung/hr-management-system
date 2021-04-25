<?php


namespace Core\Logging\Entities;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasPermissions;

class Loggingactivity extends Model
{
    protected static function boot()
    {
        parent::boot();
    }

    protected $table = 'logging_activity';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['userId', 'level','method', 'action', 'detail', 'created_at','type'];

    public function User() {
        return $this->belongsTo(User::class, "userId");
    }
}
