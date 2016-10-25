<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categoryLast = DB::table('categories')
            ->orderBy('order', 'desc')
            ->pluck('order')
            ->first();

        $category = new Category;


        $category->name = str_replace(' ', '_', mb_strtolower($request->name));;
        $category->order = $categoryLast + 1;

        $category->save();

        return redirect()->back();


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $categories = DB::table('categories')
            ->orderBy('order', 'desc')
            ->pluck('name')
            ->toArray();

        foreach ($categories as $category) {
            DB::table('categories')
                ->where('name', $category)
                ->update(['order' => $request->input($category)]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('categories')->where('id', $id)->delete();

        return redirect()->back();
    }

}
