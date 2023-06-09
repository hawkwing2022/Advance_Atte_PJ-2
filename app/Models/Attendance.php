<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'start_time'];
    

    public function getAtte(){
        return $this::where([
            ['user_id', '=', $user->id],
            ['date', '=', $yyyy_mm_dd]
            ])->get();
    }

    public function rest()
    {
        return $this->hasOne('App\Models\Rest');
    }

    public function rests()
    {
        return $this->hasMany('App\Models\Rest');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
