@extends('layout')

@section('content')
<div style="background: #FFF;" class="container">
    <a style="margin-top: 15px;" class="btn btn-success" href="{!! route('posts.index') !!}">Back to list</a>
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">{!! $post->title !!}</h2>
                <p class="blog-post-meta">{!! date("F j, Y", strtotime($post->created_at)) !!}</a></p>
                <hr>
                <div id="content">
                    {!! $post->content !!}
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

@endsection

@push('afterScripts')
<script type="text/javascript">
    $(function() {
        var content = $('#content');
        var converter = new showdown.Converter();
        content.html(converter.makeHtml({!! json_encode($post->content) !!}));
    });
</script>
@endpush
