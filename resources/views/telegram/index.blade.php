@extends('layouts.main')
@section('content')
    <div style="padding: 40px">
        <form method="POST" action="{{route('bot.send')}}">
            @csrf
            <label for="message">{{$asd}}</label>
            <input id="message" type="text">
            <button type="submit">Отправить</button>
        </form>
    </div>
@endsection
