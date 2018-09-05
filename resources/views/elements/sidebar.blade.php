<?php
/**
 * Created by PhpStorm.
 * User: Mac_P.sinh
 * Date: 9/5/18
 * Time: 12:36
 */
?>
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hot</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">New</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @foreach($hotVideos as $video)
            <ul class="list-unstyled">
                <li class="media">
                    <img class="mr-3" width="64" height="64" src="{{ get_facebook_thumb($video->video_id, $video->source) }}" alt="{{$video->name}}">
                    <div class="media-body">
                        <a href="/video/{{ $video->id }}"><h6 class="mt-0 mb-1">{{$video->name}}</h6></a>
                    </div>
                </li>
            </ul>
        @endforeach
    </div>
    <div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
        @foreach($newVideos as $video)
            <ul class="list-unstyled">
                <li class="media">
                    <img class="mr-3" width="64" height="64" src="{{ get_facebook_thumb($video->video_id, $video->source) }}" alt="{{$video->name}}">
                    <div class="media-body">
                        <a href="/video/{{ $video->id }}"> <h6 class="mt-0 mb-1">{{$video->name}}</h6></a>
                    </div>
                </li>
            </ul>
        @endforeach
    </div>
</div>

{{--<iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FHappyLuckyPets%2Fvideos%2F1710926312346951%2F&show_text=0&width=476" width="476" height="476" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>--}}
