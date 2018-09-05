<?php

namespace App\Http\Controllers;

use App\Forms\VideoForm;
use App\Http\Models\Videos;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Kris\LaravelFormBuilder\FormBuilder;

class VideosController extends Controller
{
    use FormBuilderTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Videos::sortable()->orderBy('id', 'DESC')->paginate(25);
        return view('videos.index', compact('videos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\VideoForm', [
            'method' => 'POST',
            'url' => route('videos.store')
        ]);
        return view('videos._form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->form(VideoForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $request->input();
        $data['video_id'] = $this->get_fb_video_id_from_url($request->input('yt_str'), $request->input('source'));
        $video = new Videos;
        $video->fill($data);
        if ($video->save()) {
            return redirect('videos')->with('success','Thêm mới thành công');
        } else {
            return redirect('videos')->with('error','Thêm mới thất bại');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $formBuilder, $id)
    {
        $model = Videos::findOrFail($id);
        $form = $formBuilder->create('App\Forms\VideoForm', [
            'method' => 'PUT',
            'url' => action('VideosController@update', $id),
            'model' => $model,
        ]);
        return view('videos._form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = $this->form(VideoForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $model = Videos::findOrFail($id);
        $data = $request->input();
        $model->video_id = $this->get_fb_video_id_from_url($request->input('yt_str'), $request->input('source'));
        if ($model->update($data)) {
            return redirect('videos')->with('success','Update thành công');
        } else {
            return redirect('videos')->with('error','Update fail!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Videos::findOrFail($id);
        if ($model->delete()) {
            return redirect('videos')->with('success','Xóa thành công');
        } else {
            return redirect('videos')->with('error','Xóa thất bại');
        }
    }

    /**
     * @param null $url
     * @return null
     */
    private function get_fb_video_id_from_url($url = null, $type = 'facebook') {
//        dd($url);
        if (!$url) {
            return null;
        }
        if ($type == 'facebook') {
            if (preg_match("~(?:t\.\d+/)?(\d+)~i", $url, $matches)) {
                return $matches[1];
            }
        } else {
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            return $my_array_of_vars['v'];
        }
        return null;
    }
}
