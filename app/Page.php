<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';

    public static function changed(){
        Page::first()->touch();
    }
}
