@extends('layouts.default')

@section('header')
<div class="nav">
  <ul>
    <li class="home_link">
      <a href="{{ route('index') }}">ホーム</a>
    </li>
    <li class="list_link">
      <a href="{{ route('list', ['yyyymmdd'=>$yyyymmdd]) }}">日付一覧</a>
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
<div class="greeting">
  <p>{{ $user_name }}さんお疲れ様です！</p>
</div>
<div class="buttons">
  <form method="POST" action="work/start">
    @csrf
    <button class="work_start" @if(isset($end_time) and is_null($end_time)) disabled @endif>勤務開始</button>
  </form>
  <form method="POST" action="work/end">
    @csrf
    <button class="work_end">勤務終了</button>
  </form>
  <form method="POST" action="rest/start">
    @csrf
    <button class="rest_start">休憩開始</button>
  </form>
  <form method="POST" action="rest/end">
    @csrf
    <button class="rest_end">休憩終了</button>
  </form>
</div>
@endsection
@section('footer')
@endsection