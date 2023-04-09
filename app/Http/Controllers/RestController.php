<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Attendance;

class RestController extends Controller
{
    public function start(Request $request)
    {
        $user_id = Auth::id();
        $start_time = date_format(Carbon::now(), 'H:i:s');
        $form = ['date'=>$date, 'start_time'=>$start_time ];
        Attendance::create($form);
        return redirect('/');
    }

    public function end(Reqeust $request)
    {
        return ('index');
    }

}
