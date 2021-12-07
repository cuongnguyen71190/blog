@extends('layout')

@section('content')
    <div class="col">
        <div class="panel panel-default">
            <div class="panel-heading has-buttons clearfix">
                <h1 class="panel-title pull-left">Manage Lists</h1>
                @auth
                    <div class="btn-group pull-right">
                        <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">Create New</a>
                    </div>
                @endauth
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        @auth
                            @if (auth()->user()->isAdmin())
                                <th>Status</th>
                            @endif
                        @endauth
                        <th>Action</th>
                    </tr>
                    </thead>
                    @if (!empty($posts))
                        <tbody>
                        @foreach($posts as $post)
                            @if($post->status || (auth()->check() && auth()->user()->isAdmin()))
                                <tr class="odd gradeX {!! $post->status ? 'table-active' : '' !!}" align="center">
                                    <td>{!! $post->id !!}</td>
                                    <td class="row-item" data-id="{!! $post->id !!}">{!! $post->title !!}</td>
                                    @auth
                                        @if (auth()->user()->isAdmin())
                                            <td>
                                                @if ($post->status == 0)
                                                    Inactive
                                                    <input type="button" name="active" value="Active Now" data-id="{!! $post->id !!}" class="btn btn-primary active-status pull-right">
                                                @else
                                                    Actived
                                                    <input type="button" name="active" value="DeActive Now" data-id="{!! $post->id !!}" class="btn btn-warning active-status pull-right">
                                                @endif
                                            </td>
                                        @endif
                                    @endauth
                                    <td>
                                        <a href="{!! route('posts.show', $post['id']) !!}" class="btn btn-success">View</a>
                                        @auth
                                            @if (auth()->user()->id === $post->user->id)
                                                <a href="{!! route('posts.edit', $post['id']) !!}" class="btn btn-warning">Edit</a>
                                                <a href="{!! route('posts.destroy', $post['id']) !!}"
                                                   onclick="event.preventDefault();
                                         document.getElementById('delete-post').submit();" class="btn btn-danger">
                                                    Delete
                                                </a>
                                                <form id="delete-post" action="{!! route('posts.destroy', $post['id']) !!}" method="POST" style="display: none;">
                                                    @method("DELETE")
                                                    @csrf
                                                </form>
                                            @endif
                                        @endauth
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection

@push('afterScripts')
    <script type="text/javascript">
        jQuery('.active-status').click(function () {
            var id = jQuery(this).attr('data-id');
            var _token = jQuery('meta[name="csrf-token"]').attr('content');
            var url = "{!! url('/posts') !!}/" + id;
            jQuery.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                data: {id: id, _method: 'PUT', _token: _token},
                success: function (d) {
                    if (d.message == 'success') {
                        location.reload();
                    }
                }
            });
        });
    </script>

@endpush
