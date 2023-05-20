@extends('user.layouts.app')
@section('title')
    New Request
@endsection

@section('content')

    @include('user.includes.nav')
    <div class="container" style="margin-top: 80px; margin-bottom: 80px; padding-top: 80px">
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
        <div class="card card-custom">
            <div class="card-body py-0">
                <form class="form" action="{{-- {{ route('add_post') }} --}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row mt-3">
                            <label class="col-lg-1 col-form-label text-right">Date:</label>
                            <div class="col-lg-3">
                                <div class="input-group date">
                                    <input type="date" name="date" class="form-control" placeholder="Select date"
                                        required />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="form-text text-muted">Please enter the date of post</span>
                            </div>

                            <label class="col-lg-1 col-form-label text-right">Name:</label>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-user"></i></span></div>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ Auth::user()->name }}" />
                                </div>
                                <span class="form-text text-muted">Please enter your username</span>
                            </div>
                        </div>



                        <hr class="solid">





                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label text-right">Short Desc.:</label>
                            <div class="col-lg-3">
                                <textarea class="form-control" name="short_desc" id="kt_autosize_1" rows="3"></textarea>
                                <span class="form-text text-muted">Please enter Short description</span>
                            </div>

                        </div>







                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button onclick="show()" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>



                <form action="{{ route('send_pusher_request') }}" method="post">
                    @csrf

                    <button href="" class="btn btn-primary mr-2">send</button>

                </form>


            </div>
        </div>

    </div>

    @include('user.includes.footer')

    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg--><svg xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->
    @include('user.includes.scribts')
    <script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 100,
                searchResultLimit: 100,
                renderChoiceLimit: 100
            });
        });

        function show() {
            $('#select_related option:selected').each(function() {
                alert($(this).val());
            });
        }

        $(function() {
            $('input').on('change', function(event) {

                var $element = $(event.target);
                var $container = $element.closest('.example');

                if (!$element.data('tagsinput'))
                    return;

                var val = $element.val();
                if (val === null)
                    val = "null";
                var items = $element.tagsinput('items');

                $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val
                    .replace('"', '\\"') + "\""));
                $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));


            }).trigger('change');
        });
    </script>
@endsection
