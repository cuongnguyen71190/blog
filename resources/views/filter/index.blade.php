@extends('layout')

@section('content')

    <div id="main">
        @if (session('success'))
            <div class="alert alert-dismissible alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading has-buttons clearfix">
                <h1 class="panel-title pull-left">Filter Post</h1>
            </div>
            <div class="panel-body">
                <form class="row" action="{{ route('filter') }}">
                <div class="form-group col-xs-12 col-md-4 insert-date">
                    <label for="between_date">Between Date</label>
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" name="date_from" id="date_from" value="{!! Request::get('date_from') !!}" class="form-control">
                        <span class="input-group-addon">to</span>
                        <input type="text" name="date_to" id="date_to" value="{!! Request::get('date_to') !!}" class="form-control">
                    </div>
                </div>

                <div class="form-group col-xs-12 col-md-2">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">Select option</option>
                            <option value="0">Inactive</option>
                            <option value="1">Actived</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-xs-12 col-md-2">
                    <label for="only_date">Only Date</label>
                    <div class="input-group only-date">
                        <input type="text" name="only_date" id="only_date" class="form-control" value="{{ Request::get('only_date') }}">
                    </div>
                </div>

                <div class="form-group col-xs-12 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>

                </form>

                <table class="table table-striped">
                    <tbody class="tbl-test">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                        @if (!empty($results))
                            @foreach ($results as $result)
                                <tr>
                                    <td>{!! $result->id !!}</td>
                                    <td>{!! $result->title !!}</td>
                                    <td>{!! $result->created_at !!}</td>
                                    @auth
                                        @if (auth()->user()->isAdmin())
                                            <td>
                                                @if ($result->status == 0)
                                                    Inactive
                                                    <input type="button" name="active" value="Active Now" data-id="{!! $result->id !!}" class="btn btn-primary active-status pull-right">
                                                @else
                                                    Actived
                                                    <input type="button" name="active" value="DeActive Now" data-id="{!! $result->id !!}" class="btn btn-warning active-status pull-right">
                                                @endif
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('afterScripts')
    <script type="text/javascript">
        $(function() {
            $('.insert-date > .input-daterange').datepicker({
                format: "yyyy-mm-dd",
                clearBtn: true,
                todayHighlight: true,
            });

            $('.only-date input').datepicker({
                format: "yyyy-mm-dd",
                clearBtn: true,
                todayHighlight: true
            });
        });
    </script>
@endpush
