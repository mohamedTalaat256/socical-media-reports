@extends('admin.layouts.app')

@section('title')
    Admin | View User
@endsection
@section('content')

 @include('admin.includes.nav')
<div class="container" style="margin-top: 10px">
    <form class="form" action="{{ route('update_user') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$user->id}}" name="id">
        <div class="card-body">
                <a href="{{ route('all_users') }}" class="btn btn-primary font-weight-bolder btn-sm">
                  back
                </a>
                <div class="form-group row">
                    <img src="{{asset('assets/images/'.$user->image)}}" alt="" style="height: 100px; margin: auto; border-radius: 25px">
                </div>
            <div class="mb-15">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Full Name:</label>
                    <div class="col-lg-6">
                        <input type="text" name="name" class="form-control" placeholder="Enter full name" value="{{ $user->name}}"/>
                        <span class="form-text text-muted">Please enter your full name</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Email address:</label>
                    <div class="col-lg-6">
                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ $user->email}}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Phone:</label>
                    <div class="col-lg-6">
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phnoe" value="{{ $user->phone}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Job:</label>
                    <div class="col-lg-6">
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phnoe" value="{{ $user->job}}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Password:</label>
                    <div class="col-lg-6">
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Image:</label>
                    <div class="col-lg-6">
                        <div class="col-lg-6">
                            <label>profile image:</label>
                            <div class="dropzone dropzone-multi" id="kt_dropzone_5">
                                <div class="dropzone-panel mb-lg-0 mb-2">
                                    <input type="file" name="image" class="dropzone-select btn btn-primary font-weight-bold btn-sm" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">read permission:</label>
                    <div class="col-lg-6">
                        <select class="form-control " name="read_permission">
                            @if ($user->read_permission == 1)
                                <option value="1">yes</option>
                                <option value="0">no</option>
                            @else
                                <option value="0">no</option>
                                <option value="1">yes</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">edit permission:</label>
                    <div class="col-lg-6">
                        <select class="form-control " name="edit_permission">
                            @if ($user->edit_permission == 1)
                                <option value="1">yes</option>
                                <option value="0">no</option>
                            @else
                                <option value="0">no</option>
                                <option value="1">yes</option>
                            @endif

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">delete permission:</label>
                    <div class="col-lg-6">
                        <select class="form-control " name="delete_permission">
                            @if ($user->delete_permission == 1)
                                <option value="1">yes</option>
                                <option value="0">no</option>
                            @else
                                <option value="0">no</option>
                                <option value="1">yes</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">add permission:</label>
                    <div class="col-lg-6">
                        <select class="form-control " name="add_permission">
                            @if ($user->add_permission == 1)
                            <option value="1">yes</option>
                            <option value="0">no</option>
                        @else
                            <option value="0">no</option>
                            <option value="1">yes</option>
                        @endif
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success mr-2">update</button>
                    <button type="reset" class="btn btn-secondary">cansel</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection
