<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Attendance;

class RestController extends Controller
{
    public function start(Request $request)
    {
        $attendance_id = Attendance::where();
        $date = date_format(Carbon::now(), 'Ymd' );
        $form = ['user_id'=>$user_id, 'date'=>$date];
        Attendance::create($form);
        return ('index');
    }

    public function end(Reqeust $request)
    {
        return ('index');
    }

}
