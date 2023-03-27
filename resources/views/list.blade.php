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
<form class="date_change_btn_form" method="POST" action="/list/$yyyymmdd">
  @csrf
  <button class="date_change_btn">＜</button>
</form>
  <p class="date_title">{{$yyyymmdd}}</p>
<form class="date_change_btn_form" method="POST" action="/list/$yyyymmdd">
  @csrf
  <button class="date_change_btn">＞</button>
</form>

@endsection
@section('footer')
@endsection