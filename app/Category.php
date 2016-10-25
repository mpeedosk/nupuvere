<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'categories';

    public static function getCategories()
    {
        $categories = DB::table('categories')->orderBy('order', 'asc')->get();
        return $categories;
    }

}
