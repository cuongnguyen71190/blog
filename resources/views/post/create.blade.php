@extends('layout')

@section('stylesheet')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('content')
    <div class="col">
        <div class="panel panel-default">
            <div class="panel-heading has-buttons clearfix">
                <h1 class="panel-title pull-left">New Post</h1>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="col-2 control-label">Title</label>
                        <div class="col-10">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-2 control-label">Body</label>
                        <div class="col-10">
                            <input id="content" type="textarea" class="form-control" name="content" value="{{ old('content') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('afterScripts')
    <script type="text/javascript">
        $(function() {
            var simplemde = new SimpleMDE({ element: document.getElementById("content") });
        });
    </script>
@endpush
