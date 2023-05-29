@extends('layouts.default')

@section('header')
@endsection
@section('main')
<div class="content_title">
  <p class="date_title">{{ $user_name }}さんお疲れ様です！</p>
</div>
<div class="buttons">
  <form method="POST" action="work/start">
    @csrf
    <button class="work_start" {{$flag_wstart}}>勤務開始</button>
  </form>
  <form method="POST" action="work/end">
    @csrf
    <button class="work_end" {{$flag_wend}}>勤務終了</button>
  </form>
  <form method="POST" action="rest/start">
    @csrf
    <button class="rest_start" name="attendance_id" value="{{ $attendance_id }}" {{ $flag_rstart }}>休憩開始</button>
  </form>
  <form method="POST" action="rest/end">
    @csrf
    <button class="rest_end" name="attendance_id" value="{{ $attendance_id }}" {{ $flag_rend }}>休憩終了</button>
  </form>
</div>
@endsection
@section('footer')
@endsection