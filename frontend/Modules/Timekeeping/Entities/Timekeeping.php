<?php

namespace Modules\Timekeeping\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timekeeping extends Model
{
    protected $table = "timekeeping";
    protected $fillable = ["id","user_id","get_to_work","get_off_work","working_day"];

    public function  user(){
        return $this->belongsTo(User::class,"user_id","id" );
    }

}
