@extends('admin.layouts.app')

@section('title')
    View Request
@endsection
@section('content')
    @include('admin.includes.nav')


    <!--begin::Content-->
    <div class="container mb-8" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4  subheader-transparent " id="kt_subheader">
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                </div>
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="d-flex">


                            <!--begin: Info-->
                            <div class="flex-grow-1">
                                <!--begin: Title-->
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="mr-3">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                            {{ $post->creator_name }}
                                        </a>
                                        <!--end::Name-->

                                        <!--begin::Contacts-->
                                        <div class="d-flex flex-wrap my-2">
                                            <a href="{{ $post->creator_link }}" target="_blank"
                                                class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <i class="fa fas fa-user icon-md mr-1"></i> {{ $post->creator_name }} profile
                                            </a>
                                            <a href="#"
                                                class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <mask fill="white">
                                                                <use xlink:href="#path-1" />
                                                            </mask>
                                                            <g />
                                                            <path
                                                                d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                @if ( $post->status == "Negative")
                                                    <span style="color: brown;font-weight: bold;"> {{ $post->status }} </span>
                                                @elseif ($post->status == "Positive")
                                                    <span style="color: rgb(20, 207, 42);font-weight: bold;"> {{ $post->status }} </span>
                                                @else
                                                    {{ $post->status }}
                                                @endif
                                            </a>
                                        </div>
                                        <!-- SHARE TO BR ENABLED : START -->

                                        <div class="d-flex flex-wrap my-2 mt-3">
                                            {{-- will target model --}}
                                            <button id="share_btn" class="btn btn-primary"
                                                onclick="getPostId({{ $post->id }})">
                                                <i class="fa fa-share"></i>
                                                Share
                                            </button>
                                        </div>

                                        <!-- SHARE TO BR ENABLED : END -->
                                        <!--end::Contacts-->
                                    </div>
                                    <div class="my-lg-0 my-1">
                                    </div>
                                </div>
                                <!--end: Title-->

                                <!--begin: Content-->
                                <div class="d-flex align-items-center flex-wrap justify-content-between">
                                    <div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">
                                        {{ $post->short_desc }}<br />
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center py-2">
                                        <div class="d-flex align-items-center mr-10">

                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Type</div>
                                                @if ($post->type=="" )
                                                <span
                                                    class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">
                                                    None
                                                </span>
                                                @else
                                                <span
                                                    class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">
                                                    {{ $post->type }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Status</div>
                                                @if ( $post->status == "Negative")
                                                <span
                                                class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold">
                                                {{ $post->status }}
                                            </span>
                                                @elseif ($post->status == "Positive")
                                                <span
                                                class="btn btn-sm btn-text btn-light-success text-uppercase font-weight-bold">
                                                {{ $post->status }}
                                            </span>
                                                @else
                                                <span
                                                class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">
                                                {{ $post->status }}
                                            </span>
                                                @endif
                                            </div>
                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Date</div>
                                                <span
                                                    class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">
                                                    {{ $post->date }}
                                                </span>
                                            </div>
                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Inserted At</div>
                                                <span
                                                    class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">
                                                    {{ $post->created_at }}
                                                </span>
                                            </div>
                                            <div class="">
                                                <div class="font-weight-bold mb-2">Added By</div>
                                                <span
                                                    class="btn btn-sm btn-text btn-light-primary font-weight-bold">
                                                    {{ $post->username }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Content-->
                            </div>
                            <!--end: Info-->
                        </div>
                        <!--<div class="separator separator-solid my-7"></div>-->
                        <!--begin: Items-->
                        <!--begin: Items-->
                    </div>
                </div>
                <!--end::Card-->
                <!--begin::Row-->

                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->

        <!--begin::Section 1-->
        <div class="mb-8">
            <div class="card card-custom p-6">
                <div class="card-body">
                    <!--begin::Heading-->
                    <i>
                        <h4 class="text-secondary">Basic Data</h4>
                    </i>
                    <!--end::Heading-->

                    <!-- Begin Separator -->
                    <div class="separator separator-solid my-7"></div>
                    <!-- End Separator -->

                    <!--begin::Content-->
                    <h5 class="text-dark-50 mb-4">Post Link:</h5>
                    <div class="text-dark-50 line-height-lg mb-8">
                        <p class="font-size-h3">
                            <a href="{{ $post->link }}">
                                {{ $post->link }}
                            </a>
                        </p>
                    </div>
                    <!--end::Content-->

                    <!--begin::Content-->
                    <h5 class="text-dark-50 mb-4">Short Description:</h5>
                    <div class="text-dark-50 line-height-lg mb-8">
                        <p class="font-size-h3">
                            {{ $post->short_desc }}
                        </p>
                    </div>
                    <!--end::Content-->


                </div>
            </div>
        </div>
        <!--end::Section 1-->

        <!--begin::Section2-->

        <!--end::Section 2-->


        {{-- modal --}}
        <div class="modal fade bd-example-modal-lg" id="share_modal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="sources_modal_body">
                    <form action="{{ route('admin_sent_complain') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">share</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="post_id" name="post_id">

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>title</label>
                                    <input type="text" name="title" class="form-control" rows="10">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>content</label>
                                    <textarea name="content" class="form-control" rows="10"> </textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>attachments</label>
                                    <input type="file" name="attachments[]" class="form-control" multiple accept=".png, .jpg, .jpeg" />
                                </div>
                            </div>





                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- modal --}}

    </div>

    <script>
        $(document).ready(function() {
            $('#related_to_select_2').select2();
        });

        function getPostId(postId) {
            $('#post_id').val(postId);
        }

        $('#share_btn').on('click', function() {
            $('#share_modal').modal('show');
        });
    </script>

@endsection
