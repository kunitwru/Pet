<?php
namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: sinhpv86
 * Date: 9/1/18
 * Time: 8:52 AM
 */
use App\Forms\FragmentForm;
use App\Models\Fragment;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Kris\LaravelFormBuilder\FormBuilder;

class FragmentController extends Controller {
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

    public function index() {
        return view('fragment.index');
    }

    public function create(FormBuilder $formBuilder) {
        $form = $formBuilder->create('App\Forms\FragmentForm', [
            'method' => 'POST',
            'url' => route('fragment.store')
        ]);
        return view('fragment._form', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->form(FragmentForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $fragment = new Fragment();
        $fragment->key = $request->input('key');
        $fragment->setTranslation('text', $request->input('language'), $request->input('text'));
        $result = $fragment->save();
        if ($result) {
            return redirect('fragment')->with('success','Thêm mới thành công');
        } else {
            return redirect('fragment')->with('error','Thêm mới thất bại');
        }

    }
}
