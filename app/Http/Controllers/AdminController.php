<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{

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
        return redirect('/admin/home');
    }

    public function home()
    {
        return view('admin.home');
    }


    public function category()
    {
        $categories = DB::table('categories')->orderBy('order', 'asc')->get();
        $count = 0;
        if (!$categories->isEmpty())
            $count = $categories->last()->order;

        return view('admin.category', ['categories' => $categories, 'count' => $count]);
    }


    public function exercise()
    {
        $exercises = DB::table('exercises')->get();

//        Session::flash('toast', 'Galerii uuendatud!');
        return view('admin.exercise', ['exercises' => $exercises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Update the gallery resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateGallery(Request $request)
    {

        $images = ['gallery1', 'gallery2', 'gallery3', 'gallery4', 'gallery5'];

        foreach ($images as $image) {
            $file = $request->file($image);
            if ($file != null) {
                $img = Image::make($file)->resize(1080, 422);
                $img->save('img/gallery/' . $image . '.png');
            }
        }

        Session::flash('main-gallery', 'Galerii uuendatud!');

        return redirect()->back();
    }

    /**
     * Update the partner logos in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateLogos(Request $request)
    {
        $file = $request->file('logo-footer');
        if ($file != null) {
            $img = Image::make($file)->resize(810, 140);
            $img->save('img/logo/footer.png');
        }

        Session::flash('main-logo', 'Logod uuendatud!');

        return redirect()->back();
    }

}
