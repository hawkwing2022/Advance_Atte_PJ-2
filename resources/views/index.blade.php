@extends('layouts.default')

@section('header')
<div class="nav">
  <ul>
    <li class="home_link">
      <a href="{{ route('index') }}">ホーム</a>
    </li>
    <li class="list_link">
      <a href="{{ route('list', ['yyyy_mm_dd'=>$yyyy_mm_dd]) }}">日付一覧</a>
    </li>
    <li class="logout_link">
      <a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">ログアウト</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    </li>
  </ul>
</div>
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
    <button class="rest_start" {{$flag_rstart}}>休憩開始</button>
  </form>
  <form method="POST" action="rest/end">
    @csrf
    <button class="rest_end" {{$flag_rend}}>休憩終了</button>
  </form>
</div>
@endsection
@section('footer')
@endsection