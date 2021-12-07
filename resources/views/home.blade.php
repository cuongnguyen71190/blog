@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
            You are logged in as {{ auth()->user()->name }}
        </div>
    </div>
@endsection
