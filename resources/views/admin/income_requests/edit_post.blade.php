@extends('admin.layouts.app')

@section('title')
    Edit Post
@endsection
<style>
    img{
        object-fit: cover;
        height: 450px;
        border-radius: 25px
    }
</style>
@section('content')
    @include('admin.includes.nav')
    <div class="container">
        <a href="{{ route('admin_all_posts') }}" class="btn btn-primary font-weight-bolder btn-sm m-2">
            back
          </a>
        <div class="row">
            <form class="form col-7" action="{{ route('admin_update_post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Date:</label>
                            <div class="input-group date">
                                <input type="date" name="date" class="form-control" value="{{$post->date}}"/>
                                <input type="hidden" name="id" class="form-control" value="{{$post->id}}"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                            <span class="form-text text-muted">Please enter the date of post</span>
                        </div>
                        <div class="col-lg-4">
                            <label>Link:</label>
                            <input type="text" name="link" class="form-control" value="{{$post->link}}" />
                            <span class="form-text text-muted">Please enter source link</span>
                        </div>
                        <div class="col-lg-4">
                            <label>Username:</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="la la-user"></i></span></div>
                                <input type="text" name="username" class="form-control" value="{{$post->username}}"/>
                            </div>
                            <span class="form-text text-muted">Please enter your username</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-8">
                            <label>Source:</label>
                            <div class="radio-inline">
                                <label class="radio radio-solid">
                                    <input type="radio" checked name="source" value="{{$post->s_id}}" required/>
                                    <span></span>
                                  {{ $post->s_name}}
                                </label>

                                @foreach ($sources as $source)
                                <label class="radio radio-solid">
                                    <input type="radio" name="source" value="{{$source->id}}" required/>
                                    <span></span>
                                  {{ $source->name}}
                                </label>
                                @endforeach


                            </div>
                            <span class="form-text text-muted">Please select the sorce type</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Short Desc.:</label>
                            <textarea class="form-control" name="short_desc" id="kt_autosize_1" rows="3">{{$post->short_desc}}</textarea>
                            <span class="form-text text-muted">Please enter Short description</span>
                        </div>
                        <div class="col-lg-8">
                            <label>Long Desc.:</label>
                            <textarea class="form-control" name="long_desc" id="kt_autosize_2" rows="3">{{$post->long_desc}}</textarea>
                            <span class="form-text text-muted">Please enter Full description</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-8">
                            <label>Status:</label>
                            <div class="radio-inline">

                                    @if ($post->status == 0)
                                    <label class="radio radio-solid">
                                        <input type="radio" name="status" checked value="0"  required />
                                        <span></span>
                                        Positive
                                    </label>

                                    @endif


                                    @if ($post->status == 1)
                                    <label class="radio radio-solid">
                                        <input type="radio" name="status" checked value="1"  required />
                                        <span></span>
                                        Negative
                                    </label>

                                    @endif
                                    @if ($post->status == 2)
                                    <label class="radio radio-solid">
                                        <input type="radio" name="status" checked value="2"  required />
                                        <span></span>
                                        N/A
                                    </label>

                                    @endif

                                    <label class="radio radio-solid">
                                        <input type="radio" name="status" value="0"  required />
                                        <span></span>
                                        Positive
                                    </label>

                                    <label class="radio radio-solid">
                                        <input type="radio" name="status"  value="1"  required />
                                        <span></span>
                                        Negative
                                    </label>

                                    <label class="radio radio-solid">
                                        <input type="radio" name="status" value="2"  required />
                                        <span></span>
                                        N/A
                                    </label>
                            </div>
                            <span class="form-text text-muted">Please select the status type</span>
                        </div>


                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Images Related:</label>
                            <div class="dropzone dropzone-multi" id="kt_dropzone_5">
                                <div class="dropzone-panel mb-lg-0 mb-2">
                                    <input type="file" name="images[]" multiple class="dropzone-select btn btn-primary font-weight-bold btn-sm" accept=".png, .jpg, .jpeg" />
                                </div>

                                <div class="dropzone-items">
                                    <div class="dropzone-item" style="display:none">
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename"
                                                title="some_image_file_name.jpg">
                                                <span data-dz-name>some_image_file_name.jpg</span>
                                                <strong>(<span data-dz-size>340kb</span>)</strong>
                                            </div>
                                            <div class="dropzone-error" data-dz-errormessage></div>
                                        </div>
                                        <div class="dropzone-progress">
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100"
                                                    aria-valuenow="0" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-toolbar">
                                            <span class="dropzone-delete" data-dz-remove><i class="flaticon2-cross"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="form-text text-muted">Max file size is 1MB and max number of
                                files is 5.</span>

                        </div>

                        <div class="col-lg-6">
                            <label>Images Screenshots:</label>
                            <div class="dropzone dropzone-multi" id="kt_dropzone_5">
                                <div class="dropzone-panel mb-lg-0 mb-2">
                                    <input type="file" name="screenshots[]" multiple class="dropzone-select btn btn-primary font-weight-bold btn-sm" accept=".png, .jpg, .jpeg" />
                                </div>

                                <div class="dropzone-items">
                                    <div class="dropzone-item" style="display:none">
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename"
                                                title="some_image_file_name.jpg">
                                                <span data-dz-name>some_image_file_name.jpg</span>
                                                <strong>(<span data-dz-size>340kb</span>)</strong>
                                            </div>
                                            <div class="dropzone-error" data-dz-errormessage></div>
                                        </div>
                                        <div class="dropzone-progress">
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" role="progressbar"  aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-toolbar">
                                            <span class="dropzone-delete" data-dz-remove><i class="flaticon2-cross"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="form-text text-muted">Max file size is 1MB and max number of files is 5.</span>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Keywords / Tags:</label>
                            <input id="kt_tagify_5" name="keyword" class="form-control tagify"  value="{{$post->keyword}}" />
                            <span class="form-text text-muted">Please insert keyword used or tags</span>
                        </div>

                        <div class="col-lg-6">
                            <label>Related To:</label>
                            <input id="kt_tagify_4" class="form-control tagify" name='related_to' value="{{$post->related_to}}" />
                            <span class="form-text text-muted">Please insert the dept. related to</span>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary mr-2">update</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-5">
                <h3>images related</h3>

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 500px">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('assets/images/' .  explode('|', $post->images)[0]) }}">
                        </div>

                        @foreach (explode('|', $post->images) as $image)
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('assets/images/' . $image) }}">
                        </div>
                         @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>


                 <h3 class="mt-3"> keywords related</h3>
                  <div id="carouselExampleControls_two" class="carousel slide" data-ride="carousel" style="height: 500px">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100"  src="{{ asset('assets/images/' .  explode('|', $post->screenshots)[0]) }}">
                        </div>

                        @foreach (explode('|', $post->screenshots) as $image)
                        <div class="carousel-item">
                            <img class="d-block w-100"src="{{ asset('assets/images/' . $image) }}">
                        </div>
                         @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls_two" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls_two" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
            </div>
        </div>
    </div>

@endsection
