@extends('layouts.default')

@section('header')
@endsection
@section('main')
<div class="content_title">
  <p class="eachList_title">{{ $name }}</p>
</div>
<div class="list_content">
  <table class="list_cont_table">
    <tr>
      <th>勤務日</th>
      <th>勤務開始</th>
      <th>勤務完了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>

    @foreach($attendances as $attendance)
    <tr>
      <td>{{ $attendance->date}}</td>
      <td>{{ $attendance->start_time }}</td>
      <td>{{ $attendance->end_time}}</td>
      <td>
        <?php $Sum_rest_period = null; ?>
        @if($attendance->rest == null)
        無休
        @else
        @if( ($attendance->rest != null) && ($attendance->rest->getRestEnd() == null) && ($attendance->date == date('Y-m-d')) )
        休憩中:1回目
        @else
        @foreach ($attendance->rests as $rest)
        @if( $attendance->rest->getRestEnd() != null )
        <?php $Sum_rest_period += $attendance->rest->getRest_period(); ?>
        @else
        <? $Sum_rest_period = '休憩中:2回目以降'; ?>
        @endif
        @endforeach
        <?php date_default_timezone_set('UTC');?>
        {{ date('H:i:s', $Sum_rest_period) }}
        <?php date_default_timezone_set('Asia/Tokyo');?>
        @endif
        @endif
      </td>
      <td>@if($attendance->end_time != null )
        <?php date_default_timezone_set('UTC');?>
        {{ date('H:i:s', (strtotime($attendance->end_time) - strtotime($attendance->start_time)) ) }}
        <?php date_default_timezone_set('Asia/Tokyo') ?>
        @elseif( $attendance->date != date('Y-m-d') )
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