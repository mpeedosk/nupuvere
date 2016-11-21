<?php

namespace App\Http\Controllers;

use App\Page;
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
        $page = Page::pluck('updated_at')->first();
        return view('admin.home', ['updated' => strtotime($page)]);
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


        $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions


        $images = ['gallery1', 'gallery2', 'gallery3', 'gallery4', 'gallery5'];

        foreach ($images as $image) {
            $file = $request->file($image);


            if ($file != null) {

                $ext = $file->guessClientExtension();
                if (!in_array($ext, $valid_exts)){
                    Session::flash('wrong-ext', 'Viga! Lubatud pildi formaadid on jpeg, jpg, png ja gif');
                    return redirect()->back();

                }

                $img = Image::make($file)->resize(1080, 422);
                $img->save('img/gallery/' . $image . '.png');
            }
        }

        Session::flash('main-gallery', 'Galerii uuendatud!');
        Page::changed();

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
        Page::changed();
        return redirect()->back();
    }

    public function upload(Request $request){

        $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $full_filename = NULL;

        $file = $request->file('image');
        $filename = str_random(20);

        $path =  'img/ex_images/';
        $full_path = $path . $filename . '.' . $file->getClientOriginalExtension();

        $ext = $file->guessClientExtension();

        $resize_width = 1800;
        $resize_height = null;

        if (in_array($ext, $valid_exts))
        {
            $image = Image::make($file)->resize($resize_width, $resize_height, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($file->getClientOriginalExtension(), 75);

            // move uploaded file from temp to uploads directory
            try{
                $image->save($full_path);
                $status = 'Image successfully uploaded!';
                $full_filename = $full_path;
            }
            catch (Exception $e){
                $status = 'Upload Fail: Unknown error occurred!';
            }
        }
        else {

            $status = 'Upload Fail: Unsupported file format or It is too large to upload!';
        }

        //echo out script that TinyMCE can handle and update the image in the editor

        return ('<script> parent.setImageValue("/' . $full_filename . '"); </script>');
    }

}
