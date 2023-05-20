@extends('admin.layouts.app')


@section('content')
@section('title')
    Admin | Dept. Repoerts
@endsection
@section('content')
    @include('admin.includes.nav')

    <div class="container">
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
        <div class="card">
            <div class="card-header">
                <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
                    All backups

                    <a href="{{ route('make_backup') }}" class="btn btn-primary">make backup</a>
                </div>
            </div>

                <div class="card-body">

                    <table class="table table-bordered border-primary table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th >#</th>
                                <th >date</th>
                                <th >#</th>
                                <th >#</th>
                            </tr>
                        </thead>
                        <?php $i=0; ?>

                        @foreach ($backups as $backup)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ Str::substr( $backup, 8, 18)  }}</td>
                                <td> <form action="download_backup" method="GET">
                                    @csrf
                                    <input type="hidden" name="file_name" value="{{ $backup }}">
                                    <input type="submit" class="btn btn-success" value="download">
                                </form></td>
                                <td>


                                    <form action="delete_backup" method="GET">
                                        @csrf
                                        <input type="hidden" name="file_name" value="{{ $backup }}">
                                        <input type="submit" class="btn btn-danger" value="delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
        </div>
    </div>
    </div>
    @include('admin.includes.user_drawer')

@endsection
