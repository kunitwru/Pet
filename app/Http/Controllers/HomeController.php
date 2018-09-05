<?php

namespace App\Http\Controllers;
use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class HomeController extends Controller
{
    public function __construct()
    {
        $hotVideos = DB::table('videos')->orderBy('view_count', 'DESC')->where(['status' => 1])->limit(5)->get();
        $newVideos = DB::table('videos')->orderBy('created_at', 'DESC')->where(['status' => 1])->limit(5)->get();
        View::share('hotVideos', $hotVideos);
        View::share('newVideos', $newVideos);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Videos::orderBy('id', 'desc')->where(['status' => 1])->paginate(15);
        return view('welcome', compact('videos'));
    }

    public function show($id) {
        $model = Videos::where('status', 1)
            ->findOrFail($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->view_count++;
        $model->save();

        $neighbors = $this->findNeighbors($model->id);

        return view('videos.show', compact('model', 'neighbors'));
    }


    /**
     * @param $id
     * @return array
     */
    public function findNeighbors($id)
    {
        $previous = DB::table('videos')
            ->select(['id', 'name'])
            ->orderBy('id',  'DESC')
            ->where('id', '<', $id)
            ->where(['status' => 1])
            ->first();
        $next = DB::table('videos')
            ->select(['id','name'])
            ->orderBy('id',  'ASC')
            ->where('id', '>', $id)
            ->where(['status' => 1])
            ->first();
        return ['prev' => $previous, 'next' => $next];
    }

}
