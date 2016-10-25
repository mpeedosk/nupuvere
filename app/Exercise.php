<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    const TEXTUAL          = 1;
    const MULTIPLE_ONE     = 2;
    const MULTIPLE_MANY    = 3;
    const ORDERING         = 4;

    const POINTS_PER_EX = 1;

    protected $table = 'exercises';

    /**
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }

}
