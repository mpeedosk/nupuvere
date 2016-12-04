<?php

namespace App\Http\Controllers;

use App\User;
use App\Page;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $page = Page::first();
        if ($page == null){
            $page = new Page;
            $page->content = "";

        }
        return view('admin.home', ['updated' => strtotime($page->updated_at), 'contact' => $page->content]);
    }

    public function admins()
    {

        $admins =DB::table('users')->where('role','>',1)->get();
        return view('admin.admins', ['admins' => $admins]);
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


    public function newAdmin()
    {

        return view('admin.auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate(request(), [
            'username' => 'required|max:255|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $role = 0;
        if ($request->role === "mod")
            $role = 2;
        else if($request->role === "admin")
            $role = 3;
        else
            abort(501);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $role,
            'points' => 0
        ]);

        Session::flash('toast', 'Kasutaja '. $request->username . " edukalt loodud!");

        return redirect('/admin/admins');
    }

    public function getAdminForEdit($a_id){
        $admin = User::find($a_id);
        return view('admin.auth.register', ['admin' => $admin]);
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
        $this->validate(request(), [
            'username' => 'required|max:255',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'required|min:6|confirmed',
        ]);

        $role = 0;
        if ($request->role === "normal")
            $role = 1;
        else if ($request->role === "mod")
            $role = 2;
        else if($request->role === "admin")
            $role = 3;
        else
            abort(501);

        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role = $role;
        $user->save();

        Session::flash('toast', 'Kasutaja '. $request->username . " edukalt uuendatud!");

        return redirect()->back();

    }

    public function destroyRegular($id)
    {
        if (intval($id) === Auth::user()->id){
            Session::flash('error', 'Iseennast ei saa kustutada');
            return($id);
            abort(420);
        }
        DB::table('users')->where('id', $id)->delete();

        Session::flash('user-delete', 'Kasutaja edukalt kustutatud');

        return redirect('/admin/admins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (intval($id) === Auth::user()->id){
            Session::flash('error', 'Iseennast ei saa kustutada');
            abort(420);
        }

        if(Auth::user()->role === User::SUPERADMIN){
            DB::table('users')->where('id', $id)->delete();
        }else if(Auth::user()->role === User::ADMIN){
            if(User::find($id)->role === 1)
                DB::table('users')->where('id', $id)->delete();
            else
                abort(403);
        }else{
            abort(403);
        }

        Session::flash('user-delete', 'Kasutaja edukalt kustutatud');

        return redirect()->back();
    }

    public function updateContact(Request $request)
    {
        $page = Page::first();
        if ($page == null){
            $page = new Page;
        }
        $page->content = $request->contact;
        $page->save();
        Session::flash('main-gallery', 'Andmed uuendatud!');

        return redirect()->back();
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


    public function highscore(){

        $all_time = DB::table('users')
            ->where([['role', 1],['points', '>', 0]])
            ->orderBy('points', 'desc')
            ->take(100)
            ->get();

        $current_year = DB::table('users')
            ->where([['role', 1], ['points_this_year', '>', 0]])
            ->orderBy('points_this_year', 'desc')
            ->take(100)
            ->get();

        return view('admin.highscore', ['all_time' => $all_time, 'this_year' => $current_year]);

    }

    public function reset(){

        DB::table('users')->update(['points_this_year' => 0]);

        Session::flash('toast', 'Punktid edukalt lähtestatud!');
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
