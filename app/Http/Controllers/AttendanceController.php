<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use APP\Models\User;
use APP\Models\Rest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Validation\Rules;


class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_name = $user->name;
        $yyyymmdd = date_format(Carbon::now(), 'Ymd' );
        $yyyy_mm_dd = date_format(Carbon::now(), 'Y-m-d' );
        $attendances = Attendance::where([
            ['user_id', '=', $user->id],
            ['date', '=', $yyyy_mm_dd]
        ])->get();
        $flag_wstart = '';
        $flag_wend = '';
        $flag_rstart = '';
        $flag_rend = '';
        if($attendances->count() == 0){
            $attendance_id = null;
            $flag_wend = 'disabled';
            $flag_rstart = 'disabled';
            $flag_rend = 'disabled';
        }elseif ($attendances->whereNull('end_time')->count() ==0){
            $attendance_id = $attendances->first()->id;
            $flag_wstart = 'disabled';
            $flag_wend = 'disabled';
            $flag_rstart = 'disabled';
            $flag_rend = 'disabled';
        }elseif(Attendance::where([
            ['user_id', '=', $user->id],
            ['date', '=', $yyyy_mm_dd]
            ])->has('rest')->count() == 0){
            $attendance_id = $attendances->first()->id;
            $flag_wstart = 'disabled';
            $flag_rend = 'disabled';
        }elseif(Rest::where([
                ['attendance_id', '=', $attendances->first()->id],
                ['date', '=', $yyyy_mm_dd],
                ['end_time', '=', null]
                ])->count() == 0){
                $attendance_id = $attendances->first()->id;
                $flag_wstart = 'disabled';
                $flag_rend = 'disabled';
        }else{
            $attendance_id = $attendances->first()->id;
            $flag_wstart = 'disabled';
            $flag_wend = 'disabled';
            $flag_rstart = 'disabled';
        }

        $param = [
            'attendance_id'=>$attendance_id,
            'user_name'=>$user_name, 
            'yyyy_mm_dd'=>$yyyy_mm_dd , 
            'flag_wstart'=>$flag_wstart,
            'flag_wend'=>$flag_wend,
            'flag_rstart'=>$flag_rstart,
            'flag_rend'=>$flag_rend
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
        $param = ['attendances'=>$attendances, 'yyyy_mm_dd'=>$date ];
        return view('list', $param);
    }

    public function page(Request $request)
    {
        $paginate->page = $page;
        view('date', ['page'->$page]);
    }

    public function login(Request $request)
    {
        $text = ['text' => 'NEW'];
        return view('auth', $text);

    }

    public function checkUser(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email,
        'password' => $password])) {
            return redirect ('/');
        } else {
            $text = '入力情報が誤っています';
        }
        return view('auth', ['text' => $text]);
    }

    public function register()
    {
        return view('registration');
    }

    public function registration(Request $request)
        {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    // {
    //     $name = $request->name;
    //     $email = $request->email;
    //     $password = $request->password;

    //     if (User::where('name', '=', $name)->count() != 0 ){
    //         $text = '既に名前が登録されています';
    //     } elseif (Auth::where('email', '=', $email)->count() != 0){
    //         $text = '既にメールアドレスが登録されています';
    //     } else
    //     {}

    //     if ($password != $request->password_confirmation){
    //         $text = 'パスワードが確認欄の内容と一致しません';
    //     } else {
    //         $text = 'OK';
    //     }

        
    //     return view('registration', ['text' => $text]);
    // }
}
