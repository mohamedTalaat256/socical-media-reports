@extends('user.layouts.app')

@section('title')
    View Post
@endsection
<style>
    .hero {
        padding: 6.25rem 0px !important;
        margin: 0px !important;
    }

    .cardbox {
        border-radius: 3px;
        margin-bottom: 20px;
        padding: 0px !important;
    }

    /* ------------------------------- */
    /* Cardbox Heading---------------------------------- */
    .cardbox .cardbox-heading {
        padding: 16px;
        margin: 0;
    }

    .cardbox .btn-flat.btn-flat-icon {
        font-size: 19px;
        height: 22px;
        width: 22px;
        padding: 0;
        overflow: hidden;
        color: rgb(0, 0, 0) !important;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }


    .cardbox .float-right .dropdown-menu {
        position: relative;
        left: 13px !important;
    }

    .cardbox .float-right a:hover {
        background: #f4f4f4 !important;
    }

    .cardbox .float-right a.dropdown-item {
        display: block;
        width: 100%;
        padding: 4px 0px 4px 10px;
        clear: both;
        font-weight: 400;
        font-size: 14px !important;
        text-align: inherit;
        white-space: nowrap;
        background: 0 0;
        border: 0;
    }

    /* ------------------------------- */
    /* Media Section---------------------------------- */
    .media {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    .d-flex {
        display: -ms-flexbox !important;
        display: flex !important;
    }

    .media .mr-3 {
        margin-right: 1rem !important;
    }

    .media img {
        width: 54px !important;
        height: 54px !important;
    }

    .media-body {
        -ms-flex: 1;
        flex: 1;
        padding: .4rem !important;
    }

    .media-body p {
        font-weight: 500 !important;
        font-size: 14px;
        color: #000000;
        font-weight: bold;
    }

    .media-body small span {
        font-size: 12px;
        margin-right: 10px;
    }


    /* ------------------------------- */
    /* Cardbox Item---------------------------------- */
    .cardbox .cardbox-item {
        position: relative;
        display: block;
    }

    .cardbox .cardbox-item img {}

    .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
    }

    .fw {
        width: 100% !important;
        height: auto;
    }


    /* ------------------------------- */
    /* Cardbox Base---------------------------------- */
    .cardbox-base {
        border-bottom: 2px solid #f4f4f4;
    }

    .cardbox-base ul {
        margin: 10px 0px 10px 15px !important;
        padding: 10px !important;
        font-size: 0px;
        display: inline-block;
    }

    .cardbox-base li {
        list-style: none;
        margin: 0px 0px 0px -8px !important;
        padding: 0px 0px 0px 0px !important;
        display: inline-block;
    }

    .cardbox-base li a {
        margin: 0px !important;
        padding: 0px !important;
    }

    .cardbox-base li a i {
        position: relative;
        top: 4px;
        font-size: 16px;
        margin-right: 15px;
    }

    .cardbox-base li a span {
        font-size: 14px;
        margin-left: 20px;
        position: relative;
        top: 5px;
    }

    .cardbox-base li a em {
        font-size: 14px;
        position: relative;
        top: 3px;
    }

    .cardbox-base li a img {
        width: 25px;
        height: 25px;
        margin: 0px !important;
        border: 2px solid #fff;
    }

    /* ------------------------------- */
    /* Author---------------------------------- */
    .author a {
        font-size: 16px;
        color: #00C4CF;
    }

    .author p {
        font-size: 16px;
    }


    .carousel-item img{
        object-fit: cover;
        height: 450px;
    }
    .post-content{
        padding-left: 16px;
        padding-right: 16px
    }

</style>
@section('content')
@include('user.includes.nav')

    <div class="container mt-3"  style="margin-top: 80px">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="cardbox shadow-lg bg-white rounded">
                    <div class="cardbox-heading">
                        <div class="dropdown float-left">
                            <a href="{{ route('posts_user') }}" class="btn btn-flat" style="font-size: 22px"> <em class="fa fa-arrow-left "></em></a>
                        </div>
                    </div>
                    <!--/ cardbox-heading -->
                    <div class="cardbox-heading">
                        <!-- START dropdown-->
                        <div class="dropdown float-right">
                            <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                <em class="fa fa-ellipsis-h"></em>
                            </button>
                        </div>
                        <!--/ dropdown -->
                        <div class="media m-0">
                            <div class="d-flex mr-3">
                                <a href=""><img class="img-fluid rounded-circle" src="{{ asset('assets/images/'.$post->user_image) }}" alt="User"></a>
                            </div>
                            <div class="media-body">
                                <a href=" ">  <p  class="m-0">{{$post->username}} </p></a>
                                <small><span><i class="icon ion-md-time"></i> {{$post->date}}</span></small>
                            </div>
                        </div>
                        <!--/ media -->
                    </div>
                    <!--/ cardbox-heading -->


                    <div class=" post-content mb-3" >
                        <div class="mt-0 mb-0 mr-3">
                                @if ($post->keyword)
                                    @foreach ( explode(',', $post->keyword) as $tag)
                                        <a href="{{-- {{ route('get_posts_keyword', ['keyword'=>$tag]) }} --}}#" class="m-0">#{{$tag}}</a>
                                    @endforeach

                                @endif
                                <p class="mt-0 mb-0">{{$post->short_desc}}</p>
                                <br>
                                <p class="mt-0 mb-0">{{$post->long_desc}}</p>
                                <a href="//{{$post->link}}"> <p class="mt-0 mb-0">{{$post->link}}</p> </a>

                                @if ($post->related_to)
                                    @foreach ( explode(',', $post->related_to) as $rel)
                                        <a href="{{-- {{ route('get_posts_related_to', ['related_to'=>$rel]) }} --}}#" class="m-0"> #{{$rel}}</a>
                                    @endforeach
                                @endif
                        </div>
                    </div>



                    @if ($post->images)
                        <div class="cardbox-item">
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
                        </div>
                    @endif

                    @if ($post->screenshots)
                        <div class="cardbox-item" style="margin-top: 50px">
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
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
