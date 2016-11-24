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

    protected $fillable = [
        'id', 'created_at', 'updated_at', 'title', 'content', 'type', 'hint',
        'solution','author','category','age_group', 'difficulty', 'solved', 'attempted' , 'licence', 'hidden'
    ];

    /**
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }


    /** Return the type name for use in views
     * @param Int $type - the type of the exercises stored in db
     * @return String
     */
    public static function getTypeNameFromInt($type){
        switch ($type) {
            case Exercise::TEXTUAL:
                return "textual";
            case Exercise::MULTIPLE_ONE:
                return "multipleone";
            case Exercise::MULTIPLE_MANY:
                return "multiplemany";
            case Exercise::ORDERING:
                return "ordering";
        }

        return 'unknown-type ' . $type;
    }

}
