<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Exercise extends Model
{
    use SearchableTrait;

    const TEXTUAL          = 1;
    const MULTIPLE_ONE     = 2;
    const MULTIPLE_MANY    = 3;
    const ORDERING         = 4;

    const POINTS_PER_EX = 1;

    const age_groups = array("avastaja", "uurija", "teadja", "ekspert");
    const difficulties = array("lihtne", "keskmine", "raske");

    protected $table = 'exercises';

    protected $fillable = [
        'id', 'created_at', 'updated_at', 'title', 'content', 'type', 'hint',
        'solution','author','category','age_group', 'difficulty', 'solved', 'attempted' , 'licence', 'hidden'
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'title' => 10,
            'content' => 7,
            'hint' => 5,
            'author' => 8,
            'category' => 3,
        ],
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
