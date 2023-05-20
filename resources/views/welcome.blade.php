@extends('user.layouts.app')
@section('title')
    Home
@endsection

@section('content')
    @if (Auth::user())
    @include('user.includes.nav')
    @endif
    <div class="container margin-auto mt-10" >

        <h1>
            welcome
        </h1>
        <div class="row">
            <div class="col">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg p-3 m-10">Uers</a>
            </div>

            <div class="col">
                <a href="{{ route('admin_login') }}" class="btn btn-primary btn-lg p-3 m-10">admin</a>
            </div>
        </div>

    </div>
    @include('user.includes.footer')
@endsection
