<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'id', 'created_at', 'updated_at', 'ex_id', 'content', 'is_correct', 'order'
    ];
}
