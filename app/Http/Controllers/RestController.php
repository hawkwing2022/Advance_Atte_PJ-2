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
        $form = ['attendance_id'=>$request->attendance_id, 'date'=>$date, 'start_time'=>$start_time ];
        Rest::create($form);
        return redirect('/');
    }

    public function end(Request $request)
    {
        $date = date_format(Carbon::now(), 'Ymd' );
        $end_time = date_format(Carbon::now(), 'H:i:s');
        Rest::where([
            ['attendance_id', '=', $request->attendance_id],
            ['end_time', '=', null],
            ])->update(['end_time'=>$end_time]);
        return redirect('/');
    }

}
