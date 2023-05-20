<div class="card card-custom gutter-b">
    <div class="card card-custom card-stretch gutter-b">
        <div class="card-body py-0">
            <div class="table-responsive">
                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                    <thead>

                        <tr class="text-left">
                            <th>Users</th>
                            <th></th>
                            <th style="min-width: 140px">progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="pr-0">
                                <div class="symbol symbol-50 symbol-light">
                                    <span class="symbol-label">
                                        <img src="{{ asset('assets/images/'.$user->image) }}" class="h-75 align-self-center">
                                    </span>
                                </div>
                            </td>
                            <td class="pl-0">
                                <a href="{{ route('view_user', ['id'=>$user->id]) }}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$user->name}}</a>
                                <span class="text-muted font-weight-bold text-muted d-block">#{{$user->id}}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column w-100 mr-2">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="text-muted mr-2 font-size-sm font-weight-bold">
                                            {{$user->progress}}
                                        </span>
                                        <span class="text-muted font-size-sm font-weight-bold">
                                            {{$user->post_count}} Posts
                                        </span>
                                    </div>
                                    <div class="progress progress-xs w-100">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$user->post_count}}%;"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
