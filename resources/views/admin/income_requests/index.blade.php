@extends('admin.layouts.app')

@section('title')
    Admin | Inbox
@endsection


@section('content')
    @include('admin.includes.nav')


    <div class="container mb-8" style="margin-top: 50px">
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


        <form action="{{ route('search_posts_date_range_admin') }}" method="get">
            <div class="row">

                <div class="form-group col-md-3">
                    <label class="text-right">Select date</label>
                    <select class="form-control" id="search_date" onchange="window.location.href=this.value;">
                        <option value="">select date</option>
                        <option value="{{ route('search_posts_date_admin', ['value' => 0]) }}">All</option>
                        <option value="{{ route('search_posts_date_admin', ['value' => 1]) }}">Today</option>
                        <option value="{{ route('search_posts_date_admin', ['value' => 2]) }}">Yesterday</option>
                        <option value="{{ route('search_posts_date_admin', ['value' => 3]) }}">Last 7 Days</option>
                        <option value="{{ route('search_posts_date_admin', ['value' => 4]) }}">Last 30 Days</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class="text-right">from</label>
                    <input type="date" name="start_date" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label class="  text-right">to</label>
                    <input type="date" name="end_date" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label style="color: #fff">search</label>
                    <button type="submit" class="btn btn-primary form-control">search</button>
                </div>
            </div>
        </form>

        <div class="card card-custom">
            <div class="card-body py-0">
                <div class="table-responsive">
                    <div class="mt-3">
                        {!! $posts->links() !!}
                    </div>
                    <table class="table table-bordered table-hover table-checkable" id="kt_advance_table_widget_1">
                        <thead>
                            <tr class="text-left">

                                <th>source</th>
                                <th>date </th>

                                <th>username</th>
                                <th>short_desc</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody id="posts_table_body">
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="font-weight-bolder">{!! $post->s_image !!}</td>
                                    <td class="font-weight-bolder">{{ $post->date }}</td>

                                    <td class="font-weight-bolder">{{ $post->username }}</td>
                                    <td class="font-weight-bolder">{{ Str::limit($post->short_desc, 20) }}</td>
                                    <td class="font-weight-bolder">
                                        @if ($post->complain_status == 0)
                                            <i class="fas fa-lock m-2 text-danger"></i>
                                            closed
                                        @elseif ($post->complain_status == 1)
                                            <i class="fas fa-folder-open m-2 text-success"></i>
                                            open
                                        @elseif($post->complain_status == 2)
                                            <i class="fas fa-clock m-2 text-primary"></i>
                                            pending

                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <a onclick="return checkDelete()"
                                            href="{{ route('admin_delete_post', ['id' => $post->id]) }}"
                                            class="btn btn-sm btn-clean btn-icon"><i class="la la-trash"></i></a>
                                        <a href="{{ route('admin_edit_post', ['id' => $post->id]) }}"
                                            class="btn btn-sm btn-clean btn-icon"> <i class="la la-edit"></i></a>
                                        <a href="{{ route('admin_view_request', ['id' => $post->id]) }}"
                                            class="btn btn-sm btn-clean btn-icon"> <i class="la la-eye"></i></a>
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
                url: '{{ URL::to('admin/search_posts') }}',
                data: {
                    'search_value': $value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    fiilTable(data);
                }
            });
        });

        $('#source_select_to').on('change', function() {
            var value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('admin/filtter_posts_by_source') }}',
                data: {
                    'search_value': value,
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
                url: '{{ URL::to('admin/filtter_posts_by_source') }}',
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
            var i = 0;
            var tBody = $('#posts_table_body');
            var list = JSON.parse(data);
            var rows = '';

            var total = 0;

            for (row in list) {

                var viewUrl = '{{ route('admin_view_request', 'id') }}';
                viewUrl = viewUrl.replace('id', list[row].id);

                var deleteUrl = '{{ route('admin_delete_post', 'id') }}';
                deleteUrl = deleteUrl.replace('id', list[row].id);

                var editUrl = '{{ route('admin_edit_post', 'id') }}';
                editUrl = editUrl.replace('id', list[row].id);

                var complain_status = list[row].complain_status;

                var complain_status_str = '';

                if (complain_status == 0) {
                    complain_status_str = '<i class="fas fa-lock m-2 text-danger"></i> closed';
                } else if (complain_status == 1) {
                    complain_status_str = '<i class="fas fa-folder-open m-2 text-success"></i> open'
                } else {
                    complain_status_str = ' <i class="fas fa-clock m-2 text-primary" ></i> pending'
                }

                rows += '<tr>' +
                    '<td class="font-weight-bolder">' + list[row].s_image + '</td>' +
                    '<td class="font-weight-bolder">' + list[row].date + '</td>' +
                    '<td class="font-weight-bolder">' + list[row].username + '</td>' +
                    '<td class="font-weight-bolder">' + list[row].short_desc.substring(0, 20) + '</td>' +
                    '<td class="font-weight-bolder">' + list[row].status + '</td>' +
                    '<td class="font-weight-bolder">' + complain_status_str +'</td>' +
                    '<td>' +
                    '<a href="' + deleteUrl +
                    '" onclick="return checkDelete()" class="btn btn-danger"><i class="fa fa-trash"></i></a>' +
                    '<a href="' + editUrl + '" class="btn btn-primary"><i class="fa fa-edit"></i></a>' +
                    '<a href="' + viewUrl + '" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>';

                rows += '<td>';
                rows += '</td>';
                rows += '</tr>';
            }
            tBody.html(rows);
        }
    </script>
@endsection
