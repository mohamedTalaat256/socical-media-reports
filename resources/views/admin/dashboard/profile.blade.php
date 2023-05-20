@extends('admin.layouts.app')
@section('title')
   Admin | Profile
@endsection
<style>
    .chat_item:hover{
        background-color: #e4e4e4;
        border-radius: 11px
    }
    .seen_message {
        color: #3445E5;

    }
</style>
@section('content')

@include('admin.includes.nav')

<div class="container">
    @if ($msg = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" style="width: 500px; margin: auto; z-index: 8888;" role="alert">
        <p>{{ $msg }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
    @endif
    @if ($msg = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible fade show"style="width: 500px; margin: auto; z-index: 8888;" role="alert">
            <p>{{ $msg }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
    @endif

    <form class="form" action="{{ route('update_admin_profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{Auth::guard('admin')->user()->id}}" name="id">
        <div class="card-body">

                <div class="form-group row">
                    <img src="{{asset('assets/images/'.Auth::guard('admin')->user()->image)}}" alt="" style="height: 100px; margin: auto; border-radius: 25px">
                </div>
            <div class="mb-15">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Full Name:</label>
                    <div class="col-lg-6">
                        <input type="text" name="name" class="form-control" placeholder="Enter full name" value="{{ Auth::guard('admin')->user()->name}}"/>
                        <span class="form-text text-muted">Please enter your full name</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Email address:</label>
                    <div class="col-lg-6">
                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email}}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Phone:</label>
                    <div class="col-lg-6">
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phnoe" value="{{ Auth::guard('admin')->user()->phone }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Job:</label>
                    <div class="col-lg-6">
                        <input type="text" name="job" class="form-control" value="{{ Auth::guard('admin')->user()->job }}"/>
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
