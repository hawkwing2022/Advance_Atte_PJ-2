<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_name = $user->name;
        $yyyymmdd = date_format(Carbon::now(), 'Ymd' );
        $param = ['user_name'=>$user_name, 'yyyymmdd'=>$yyyymmdd];
        return view('index', $param);
    }

    public function start(Request $request)
    {
        return view('index', $request);
    }

    public function end(Request $request)
    {
        return view('index', $request);
    }

    public function date(Request $request)
    {
        $date = $request->yyyymmdd;
        $data = Attendance::where('date')->paginate(5);
        return view('date', ['yyyymmdd'=>$date]);
    }

    public function page(Request $request)
    {
        $paginate->page = $page;
        view('date', ['page'->$page]);
    }

}
