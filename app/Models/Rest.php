<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_id', 'date', 'start_time'];

    public function attendance()
    {
        return $this->belongsTo('App\Models\Attendance');
    }

    // public function chkNotFilledRestEnd(Request $request)
    // {
    //     $boolean = Rest::where($request)->whereNull('end_time')->count() != 0;
    //     return $boolean;
    // }

    public function getRest_period()
    {
        $rest_period = strtotime($this->end_time) - strtotime($this->start_time);
        return $rest_period;
    }

    public function getRestEnd()
    {
        if($this->id == 19){dd($this->end_time);}
        return $this->end_time;
    }
}
