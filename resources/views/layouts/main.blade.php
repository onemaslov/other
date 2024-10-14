@extends('layouts.frame')
@section('body')
    <div class="body_content">
        <div class="sidebar">
            @include('layouts.sidebar')
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
@endsection
