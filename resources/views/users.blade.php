@extends('layouts.default')

@section('header')
<div class="nav">
  <ul>
    <li class="link">
      <a href="{{ route('index') }}">ホーム</a>
    </li>
    <li class="link">
      <a href="{{ route('list', ['yyyy_mm_dd'=>$yyyy_mm_dd]) }}">日付一覧</a>
    </li>
    <li class="link">
      <a href="{{ route('users') }}">ユーザー一覧</a>
    </li>
    <li class="link">
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
  <p class="userlist_title">ユーザー一覧</p>
</div>
<div class="user_list_content">
  <table class="user_list_cont_table">
    <tr>
      <th>名前</th>
      <th>メールアドレス</th>
      <th>勤怠表ページ</th>
    </tr>

    @foreach($users as $user)
    <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        <form class="eachList_btn_form" method="post" action="{{ route('eachList', $user->id) }}">
          @csrf
          <button class="eachList_btn">個別勤怠表</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="paginate">
  {{ $users -> links() }}
</div>
@endsection
@section('footer')
@endsection