@extends('admin.layouts.app')

@section('title')
    Admin | Users
@endsection

@section('content')
    @include('admin.includes.nav')


    <div class="card card-custom container">
        <div class="card">
            @if ($msg = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show"
                    style="width: 500px; margin: auto; z-index: 8888;" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($msg = Session::get('danger'))
                <div class="alert alert-danger alert-dismissible fade show"
                    style="width: 500px; margin: auto; z-index: 8888;" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                            aria-hidden="true">&times;</span> </button>
                </div>
            @endif
            <div class="card-body py-0">
                <div class="table-responsive">

                        <form action="{{ route('search_users_from_to') }}" method="get">
                            <div class="row mt-5">
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

                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                        <thead>
                            <tr class="text-left">
                                <th class="pr-0" style="width: 50px">users </th>
                                <th style="min-width: 150px"></th>
                                <th style="min-width: 150px">post count </th>
                                <th style="min-width: 100px" class="text-right">
                                    <a href="{{ route('new_user') }}"
                                        class="btn btn-light-success font-weight-bolder btn-sm">
                                        new user
                                    </a>

                                    <a href="{{ route('new_admin') }}"
                                        class="btn btn-light-success font-weight-bolder btn-sm">
                                        new admin
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="pr-0">
                                        <div id="complain_image" class="image-input-wrapper mr-3" style="border-radius: 50%; height: 45px; width: 45px; background-image: url({{ asset('assets/images/' . $user->image) }});background-repeat: no-repeat;
                                                background-size: cover; ">
                                        </div>
                                    </td>
                                    <td class="pl-0">
                                        <a href="{{ route('view_user', ['id' => $user->id]) }}"
                                            class="text-dark-75 font-weight-bolder text-hover-primary  font-size-lg">{{ $user->name }}</a>
                                    </td>
                                    <td>{{ $user->post_count }}</td>

                                    <td class="text-right"><a href="#" onclick="showModal({{ $user->id }})"
                                            class="btn btn-light-primary font-weight-bolder btn-sm">reports</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!--end::Table-->
            </div>






            <div class="card-body py-0">
                <div class="table-responsive">
                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                        <thead>
                            <tr class="text-left">
                                <th class="pr-0" style="width: 50px">admin </th>
                                <th></th>
                                <th>job</th>
                                <th>email</th>
                                <th>phone</th>
                                <th style="min-width: 100px" class="text-right">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td class="pr-0">
                                        <div id="complain_image" class="image-input-wrapper mr-3" style="border-radius: 50%; height: 50px; width: 50px; background-image: url({{ asset('assets/images/' . $admin->image) }});     background-repeat: no-repeat;
                                    background-size: cover; ">
                                        </div>
                                    </td>
                                    <td class="pl-0">
                                        <a href="#"
                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $admin->name }}</a>
                                        <span
                                            class="text-muted font-weight-bold text-muted d-block">#{{ $admin->id }}</span>
                                    </td>
                                    <td class="pl-0">{{ $admin->job }}</td>
                                    <td class="pl-0">{{ $admin->email }}</td>
                                    <td class="pl-0">{{ $admin->phone }}</td>

                                    @if (Auth::guard('admin')->user()->is_super == 1)
                                        <td class="text-right">
                                            <a onclick="return checkDelete()"
                                                href="{{ route('delete_admin', ['id' => $admin->id]) }}"
                                                class="btn btn-danger font-weight-bolder btn-sm"> delete</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="details_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="sources_modal_body">
                <div class="modal-header">
                    <h5 class="modal-title" id="sources_modal_label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="user_info" class="row">

                    </div>

                    <div>
                        <div class="row mt-5">
                            <input type="hidden" id="user_id" value="">
                            <div class="form-group col-md-3">
                                <label class="text-right">from</label>
                                <input type="date" id="posts_start_date" name="posts_start_date" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="  text-right">to</label>
                                <input type="date" id="posts_end_date" name="posts_end_date" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label style="color: #fff">search</label>
                                <button id="search" class="btn btn-primary form-control">search</button>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="text-right">Select date</label>
                                <select class="form-control" id="search_date">
                                    <option value="0">All</option>
                                    <option value="1">Today</option>
                                    <option value="2">Yesterday</option>
                                    <option value="3">Last 7 Days</option>
                                    <option value="4">Last 30 Days</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>count</th>
                                <th>source</th>
                            </tr>
                        </thead>
                        <tbody id="source_tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @include('admin.includes.user_drawer')

    <script>
        var base_url = APP_URL;

        function showModal(userId) {

            $.ajax({
                type: 'get',
                url: base_url + 'admin/user_posts_report/' + userId,
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    fillContent(data);
                    $('#details_modal').modal('show');
                }
            });


        }


        $('#search').on('click', function() {
            var url = base_url + "admin/user_posts_report_search_from_to";

            $.ajax({
                type: 'get',
                url: url,
                data: {
                    'user_id': $('#user_id').val(),
                    'posts_start_date': $('#posts_start_date').val(),
                    'posts_end_date': $('#posts_end_date').val(),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    fillContent(data);
                    $('#details_modal').modal('show');
                }
            });
        });

        $('#search_date').on('change', function() {
            var url = base_url + "admin/search_posts_date_of_user";
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    'user_id': $('#user_id').val(),
                    'date_value': $('#search_date').val(),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    fillContent(data);
                }
            });
        });


        function fillContent(data) {
            var response = JSON.parse(data);
            var list = response.posts;
            var user = response.user;

            $('#user_id').val(user.id);


            var start_date = $('#posts_start_date').val();
            var end_date = $('#posts_end_date').val();
            var user_id = $('#user_id').val();
            var date_value = $('#search_date').val();


            var html = '';
            var html_user = '';

            var total = 0;

            var postUrl = '';

            for (var i in list) {


                if (start_date == '' && end_date == '') {
                    postUrl = base_url + 'admin/get_user_postes_in_select_date/' + user_id + '/' + date_value;
                } else {
                    postUrl = base_url + 'admin/get_user_postes_from_to/' + user_id + '/' + start_date + '/' + end_date;

                }


                html += '<tr>';
                html += '   <td>' + list[i].post_count + '</td>';
                html += '   <td>';
                html += '    <a href="' + postUrl + '/' + list[i].s_id +
                    '" class="coltext-dark-75 mt-3 font-weight-bolder text-hover-primary font-size-lg">';
                html += list[i].image + ' ' + list[i].name;
                html += '</a>';
                html += '</td>';
                html += '</tr>';

                total += list[i].post_count;
            }

            html += '<tr><th>total</th><th>' + total + '</th></tr>';

            html_user += '<div ';
            html_user += '<div class="image-input-wrapper mr-3 "' +
                'style="border-radius: 50%; height: 45px; width: 45px; background-image: url(' +
                base_url + 'assets/images/' + user.image + ');' +
                'background-repeat: no-repeat; background-size: cover; "></div>';

            html_user += '<a href="' + base_url + 'admin/view_user/' + user.id +
                '" class="coltext-dark-75 mt-3 font-weight-bolder text-hover-primary font-size-lg">' + user.name + '</a>';

            html_user += '</div>';

            $('#source_tbody').html(html);
            $('#user_info').html(html_user);
        }
    </script>
@endsection
