@extends('admin.layouts.app')


@section('content')
@section('title')
    Admin | Dashboard
@endsection
@section('content')
    @include('admin.includes.nav')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Dashboard </h5>
                </div>

            </div>
        </div>



        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" style="width: 500px; margin: auto; z-index: 8888;"
                role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Dashboard-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-3">
                        {{-- @include('admin.includes.weeklystats') --}}
                    </div>
                    <div class="col-xl-6">

                        @include('admin.includes.users')
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.footer')
    </div>
    </div>
    </div>



    <!--begin::Scrolltop-->
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

    <script>
        function filtterPostsBySource(id) {
            $.ajax({
                type: 'get',
                url: '{{ URL::to('filtter_posts_by_source') }}',
                data: {
                    'search_value': id,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    //
                }
            });
        }
    </script>


    <script>
        var HOST_URL = "";
    </script>


    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
@endsection
