<?php


namespace Core\Logging\Entities;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasPermissions;

class Logging extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    protected $table = 'logging';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['userId', 'level','method', 'action', 'detail', 'created_at','created_by','type'];

    public function User() {
        return $this->belongsTo(User::class, "userId");
    }
}
