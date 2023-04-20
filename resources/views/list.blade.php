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
  <form class="date_change_btn_form" method="GET" action="{{ route('list', ['yyyy_mm_dd'=>date('Y-m-d', strtotime("$yyyy_mm_dd -1 day")) ]) }}">
    @csrf
    <button class="date_change_btn">＜</button>
  </form>
  <p class="date_title">{{$yyyy_mm_dd}}</p>

  <form class="date_change_btn_form" method="GET" action="{{ route('list', ['yyyy_mm_dd'=>date('Y-m-d', strtotime("$yyyy_mm_dd +1 day")) ]) }}">
    @csrf
    <button class="date_change_btn">＞</button>
  </form>
</div>
<div class="list_content">
  <table class="list_cont_table">
    <tr>
      <th>名前</th>
      <th>勤務開始</th>
      <th>勤務完了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>

    @foreach($attendances as $attendance)
    <tr>
      <td>{{ $attendance->user->getName() }}</td>
      <td>{{ $attendance->start_time }}</td>
      <td>{{ $attendance->end_time}}</td>
      <?php $Sum_rest_period = null; ?>
      <td>
        @if( $attendance->rest != null )
        @foreach ($attendance->rests as $rest)
        @if( $attendance->rest->getRestEnd() != null )
        <?php $Sum_rest_period += $attendance->rest->getRest_period(); ?>
        @else
        休憩中
        @endif
        @endforeach
        <?php date_default_timezone_set('UTC');?>
        {{ date('H:i:s', $Sum_rest_period) }}
        <?php date_default_timezone_set('Asia/Tokyo') ?>
        @elseif( $attendance->rest != null && $attendance->rest->getRestEnd() == null && $yyyy_mm_dd == date('Y-m-d') )
        休憩中
        @endif
      </td>
      <td>@if($attendance->end_time != null )
        <?php date_default_timezone_set('UTC');?>
        {{ date('H:i:s', (strtotime($attendance->end_time) - strtotime($attendance->start_time)) ) }}
        <?php date_default_timezone_set('Asia/Tokyo') ?>
        @elseif( $yyyy_mm_dd != date('Y-m-d') )
        打刻漏れ
        @else
        勤務中
        @endif</td>
    </tr>
    @endforeach
  </table>
</div>
<div class="paginate">
  {{ $attendances -> links() }}
</div>
@endsection
@section('footer')
@endsection