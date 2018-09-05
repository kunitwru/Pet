@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="page-title pull-left">{{ trans('home.greeting') }}</span>
                        <small class="pull-right">
                            <a href="/videos/create" class="btn btn-sm btn-success">Add</a>
                        </small>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>@sortablelink('id', '#')</th>
                                <th>@sortablelink('video_id', 'Image')</th>
                                <th>@sortablelink('name', __('name'))</th>
                                <th>@sortablelink('source', 'Source')</th>
                                <th>@sortablelink('view_count', 'View')</th>
                                <th>@sortablelink('status', 'Status')</th>
                                <th style="width: 120px">{{ __('video.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($videos as $video)
                                <tr>
                                    <td>{{$video->id}}</td>
                                    <td><img src="{{ get_facebook_thumb($video->video_id, $video->source) }}" width="120" height="120" /> </td>
                                    <td>{{$video->name}}</td>
                                    <td>{{$video->source}}</td>
                                    <td>{{$video->view_count}}</td>
                                    <td>{!! ($video->status) ? '<span class="badge badge-success">ON</span>' : '<span class="badge badge-danger">OFF</span>' !!}</td>

                                    <td>
                                            <a target="_blank" href="/video/{{$video->id}}" class="btn btn-sm btn-info pull-left"><i class="fa fa-eye"></i></a>
                                            <a href="/videos/{{$video->id}}/edit" class="btn btn-sm btn-primary pull-left"><i class="fa fa-pencil-square-o"></i></a>
                                            <form action="{{action('VideosController@destroy', $video->id)}}" class="pull-left" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
