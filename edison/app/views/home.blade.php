@if (Auth::check())
    {{ Auth::user()->screen_name }}ログイン中
    <a href="/logout">ログアウト</a>
@else
        ログインしてまへん
    <a href="/login">ログイン</a>
@endif