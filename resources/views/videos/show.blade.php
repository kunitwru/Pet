@extends('layout.app')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <h1>{{ $model->name }}</h1>
            <hr />
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-8">
                    @if(!empty($neighbors['prev']))
                        <a href="/video/{{ $neighbors['prev']->id }}" class="pull-left"><i class="fa fa-arrow-left"></i><small> {{ $neighbors['prev']->name }}</small> </a>
                    @endif
                    @if(!empty($neighbors['next']))
                        <a href="/video/{{ $neighbors['next']->id }}"  class="pull-right"><small>{{ $neighbors['next']->name }}</small> <i class="fa fa-arrow-right"></i> </a>
                    @endif

                     <div class="align-baseline"></div>
                    <p style="margin: 20px 0; display: inline-block; width: 100%;">
                        <small class="pull-left"><i class="fa fa-clock-o"></i> {{ $model->created_at->diffForHumans() }}</small>
                        <small class="pull-right" style="text-transform: capitalize">
                            @if ($model->source == 'facebook')
                                <i class="fa fa-facebook-square"></i>
                            @else
                                <i class="fa fa-youtube-square"></i>
                            @endif
                            {{ $model->source }}
                        </small>
                    </p>
                        @if($model->source == 'facebook')
                            <iframe src="https://www.facebook.com/plugins/video.php?href={{ $model->yt_str }}&show_text=0&mute=0&width=476" width="476" style="width: 100%; height: 100%; border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true" data-autoplay="true"></iframe>
                        @else
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $model->video_id }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        @endif
                    <div class="clearfix"></div>
                    <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
                </div>
                <div class="col-md-4">
                    @include('elements.sidebar')
                </div>
            </div>

        </div>
    </div>

@endsection
