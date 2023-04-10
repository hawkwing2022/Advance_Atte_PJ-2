<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use APP\Models\User;
use APP\Models\Rest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_name = $user->name;
        $yyyymmdd = date_format(Carbon::now(), 'Ymd' );
        $yyyy_mm_dd = date_format(Carbon::now(), 'Y-m-d' );
        if(Attendance::where([
            ['user_id', '=', $user->id],
            ['date', '=', $yyyy_mm_dd]
            ])->count() == 0){
                $flag_wstart = '';
                $flag_wend = 'disabled';
                $flag_rstart = 'disabled';
                $flag_rend = 'disabled';
            }elseif(
                Attendance::where([
                    ['user_id', '=', $user->id],
                    ['date', '=', $yyyy_mm_dd]
                    ])->whereNull('end_time')->count() ==0){
                        $flag_wstart = 'disabled';
                        $flag_wend = 'disabled';
                        $flag_rstart = 'disabled';
                        $flag_rend = 'disabled';
                    }elseif(
                        Attendance::where([
                            ['user_id', '=', $user->id],
                            ['date', '=', $yyyy_mm_dd]
                            ])->rest != null
                        ){
                            if(Attendance::where([
                                ['user_id', '=', $user->id],
                                ['date', '=', $yyyy_mm_dd]
                                ])->rest->chkNotFilledRestEnd()){
                                    $flag_wstart = 'disabled';
                                    $flag_wend = '';
                                    $flag_rstart = 'disabled';
                                    $flag_rend = '';
                                }
                            }else{
                                    $flag_wstart = 'disabled';
                                    $flag_wend = '';
                                    $flag_rstart = '';
                                    $flag_rend = 'disabled';
                                };
        $param = [
            'user_name'=>$user_name, 
            'yyyy_mm_dd'=>$yyyy_mm_dd , 
            'flag_wstart'=>$flag_wstart,
            'flag_wend'=>$flag_wend,
            'flag_rstart'=>$flag_rstart,
            'flag_rend'=>$flag_rend,
        ];
        return view('index', $param);
    }

    public function start(Request $request)
    {
        $user_id = Auth::id();
        $date = date_format(Carbon::now(), 'Ymd' );
        $start_time = date_format(Carbon::now(), 'H:i:s');
        $form = ['user_id'=>$user_id, 'date'=>$date, 'start_time'=>$start_time ];
        Attendance::create($form);
        return redirect('/');
    }

    public function end(Request $request)
    {
        $user_id = Auth::id();
        $yyyy_mm_dd = date_format(Carbon::now(), 'Y-m-d' );
        $end_time = date_format(Carbon::now(), 'H:i:s');
        Attendance::where([
            ['user_id','=',$user_id],
            ['date', '=', $yyyy_mm_dd]
            ])->update(['end_time'=>$end_time]);
        return redirect('/');
    }

    public function list(Request $request)
    {
        $date = $request->yyyy_mm_dd;
        $attendances = Attendance::where('date', '=', $date)->orderBy('user_id')->Paginate(5);
        $param = ['attendances'=>$attendances, 'yyyy_mm_dd'=>$date];
        return view('list', $param);
    }

    public function page(Request $request)
    {
        $paginate->page = $page;
        view('date', ['page'->$page]);
    }

}
