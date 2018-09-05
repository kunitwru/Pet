@extends('layout.app')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <a href="/video/{{ $video->id }}">
                                <img class="card-img-top" alt="{{ $video->name }}" style="height: 225px; width: 100%; display: block;"
                                     src="{{ get_facebook_thumb($video->video_id, $video->source) }}" data-holder-rendered="true">
                            </a>
                            <div class="card-body">
                                <a class="card-text" href="/video/{{ $video->id }}" title="{{ $video->name }}">{{ $video->name }}</a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $video->created_at->diffForHumans() }}</small>
                                    <small class="text-right text-muted">{{ $video->view_count }} <i class="fa fa-eye"></i> </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{ $videos->links() }}

        </div>
    </div>

@endsection
