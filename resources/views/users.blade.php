@extends('layouts.default')

@section('header')
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