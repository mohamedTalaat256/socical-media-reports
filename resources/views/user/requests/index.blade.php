@extends('user.layouts.app')
@section('title')
    My Requests
@endsection


@section('content')

    @include('user.includes.nav')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" style="width: 500px; margin: auto; z-index: 8888;"
            role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible fade show" style="width: 500px; margin: auto; z-index: 8888;"
            role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container"  style="margin-top: 80px">

        <!--begin::Notice-->
        <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
            <div class="alert-text">
                <div class="form-inline">
                    <form action="{{ route('search_posts_date_range_user') }}" class="row" method="get">
                        <div class="form-group mb-2 ">
                            <label class="text-right m-2">Select date</label>
                            <select class="form-control  col" id="search_date" onchange="window.location.href=this.value;">
                                <option value="">select date</option>
                                <option value="{{ route('search_posts_date_user', ['value' => 0]) }}">All</option>
                                <option value="{{ route('search_posts_date_user', ['value' => 1]) }}">Today</option>
                                <option value="{{ route('search_posts_date_user', ['value' => 2]) }}">Yesterday</option>
                                <option value="{{ route('search_posts_date_user', ['value' => 3]) }}">Last 7 Days</option>
                                <option value="{{ route('search_posts_date_user', ['value' => 4]) }}">Last 30 Days</option>
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <div class="form-group col">
                                <label class=" text-right m-2">from</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <div class="form-group col">
                                <label class="  text-right m-2">to</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">search</button>
                    </form>
                </div>
            </div>
        </div>

        <!--end::Notice-->

        <div class="card card-custom">
            <div class="card-body py-0">
                <div class="table-responsive">
                    <div class="mt-3">
                        {!! $posts->links() !!}
                    </div>
                    <!--<table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">-->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
                        style="margin-top: 13px !important">
                        <thead>
                            <tr class="text-left">

                                <th>Source</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Short Desc.</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="posts_table_body">
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{!! $post->s_image !!}</td>
                                    <td>{{ $post->date }}</td>
                                    <td style="white-space: nowrap;">{{ $post->username }}</td>
                                    <td style="white-space: nowrap;">{{ Str::limit($post->short_desc, 15) }}</td>
                                    <td>{{ $post->status }}</td>

                                    <td style="white-space: nowrap;">
                                       {{--  @if (Auth::user()->delete_permission == 1) --}}
                                            <a onclick="return checkDelete()"
                                                href="{{ route('delete_post', ['id' => $post->id]) }}"
                                                class="btn btn-sm btn-clean btn-icon"><i class="la la-trash"></i></a>
                                      {{--   @endif
                                        @if (Auth::user()->edit_permission == 1) --}}
                                            <a href="{{ route('edit_post', ['id' => $post->id]) }}"
                                                class="btn btn-sm btn-clean btn-icon" title="Edit"><i
                                                    class="la la-edit"></i></a>
                                       {{--  @endif
                                        @if (Auth::user()->read_permission == 1) --}}
                                            <a href="{{ route('view_post', ['id' => $post->id]) }}"
                                                class="btn btn-sm btn-clean btn-icon"><i class="la la-eye"></i></a>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $('#nav_search_input').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('search_posts') }}',
                data: {
                    'search_value': $value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    fiilTable(data);
                }
            });
        });

        function filtterPostsBySource(id) {
            $.ajax({
                type: 'get',
                url: '{{ URL::to('filtter_posts_by_source') }}',
                data: {
                    'search_value': id,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    fiilTable(data);
                }
            });
        }

        function fiilTable(data) {
            var user_read = {!! auth()->user()->read_permission !!};
            var user_edit = {!! auth()->user()->edit_permission !!};
            var user_add = {!! auth()->user()->add_permission !!};
            var user_delete = {!! auth()->user()->delete_permission !!};
            var i = 0;
            var tBody = $('#posts_table_body');
            var list = JSON.parse(data);
            var rows = '';
            var total = 0;

            for (row in list) {
                var viewUrl = '{{ route('view_post', 'id') }}';
                viewUrl = viewUrl.replace('id', list[row].id);

                var editUrl = '{{ route('edit_post', 'id') }}';
                editUrl = editUrl.replace('id', list[row].id);

                var deleteUrl = '{{ route('delete_post', 'id') }}';
                deleteUrl = deleteUrl.replace('id', list[row].id);

                rows += '<tr>' +
                    '<td >' + list[row].s_image + '</td>' +
                    '<td >' + list[row].date + '</td>' +
                    '<td > <a target="_blanck" href="//' + list[row].link + '">' + list[row]
                    .link + '</a></td>' +
                    '<td >' + list[row].username + '</td>' +
                    '<td >' + list[row].short_desc.substring(0, 20) + '</td>' +
                    '<td >' + list[row].long_desc.substring(0, 20) + '</td>' +
                    '<td >' + list[row].status + '</td>' +
                    '<td >' + list[row].keyword.substring(0, 20) + '</td>' +
                    '<td >' + list[row].related_to.substring(0, 20) + '</td>';
                rows += '<td>';
                if (user_delete == 1) {
                    rows += '<a onclick="return checkDelete()" href="' + deleteUrl +
                        '"  class="btn btn-sm btn-clean btn-icon"><i class="la la-trash"></i></a>'
                }
                if (user_edit == 1) {
                    rows += '<a href="' + editUrl + '" class="btn btn-sm btn-clean btn-icon"><i class="la la-edit"></i></a>'
                }
                if (user_read == 1) {
                    rows += '<a href="' + viewUrl + '" class="btn btn-sm btn-clean btn-icon"><i class="la la-eye"></i></a>'
                }
                rows += '</td>';
                rows += '</tr>';
            }

            tBody.html(rows);
        }
    </script>
    @include('user.includes.footer')
@endsection
