<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function users()
    {
        $users = User::Paginate(5);
        $yyyy_mm_dd = date_format(Carbon::now(), 'Y-m-d' );
        $param = [ 'users'=>$users, 'yyyy_mm_dd'=>$yyyy_mm_dd ];
        return view('users', $param);
    }

    public function page(Request $request)
    {
        $paginate->page = $page;
        view('users', ['page'->$page]);
    }

    public function eachList(Request $request)
    {
        $attendances = Attendance::where('user_id', '=', $request->user_id)->Paginate(5);
        $yyyy_mm_dd = date_format(Carbon::now(), 'Y-m-d' );
        $name = User::find($request->user_id)->name;
        $param = [ 'attendances'=>$attendances, 'yyyy_mm_dd'=>$yyyy_mm_dd, 'name'=>$name ];
        return view('each-list', $param);
    }

}
