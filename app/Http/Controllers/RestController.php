<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Attendance;
use Carbon\Carbon;

class RestController extends Controller
{
    public function start(Request $request)
    {
        $date = date_format(Carbon::now(), 'Ymd' );
        $start_time = date_format(Carbon::now(), 'H:i:s');
        $form = ['date'=>$date, 'start_time'=>$start_time ];
        Attendance::create($form);
        return redirect('/');
    }

    public function end(Reqeust $request)
    {
        $attendance_id = Attendance::id();
        $end_time = date_format(Carbon::now(), 'H:i:s');
        Rest::where([
            ['attendance_id', '=', $attendance_id],
            ['end_time', '=', null],
            ])->update(['end_time'=>$end_time]);
        return redirect('/');
    }

}
