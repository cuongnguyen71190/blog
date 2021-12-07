@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="col control-label">E-Mail</label>
                                <div class="col">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col control-label">Password</label>
                                <div class="col">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
