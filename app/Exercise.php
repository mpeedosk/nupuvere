<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{

    /**
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }

    public static function getAgeIntFromName($name)
    {
        switch ($name) {
            case "avastaja":
                return 1;
            case "uurija":
                return 2;
            case "teadja":
                return 3;
            case "ekspert":
                return 4;
        }
        return 0;
    }

    public static function getDifficultyIntFromName($name)
    {
        switch ($name) {
            case "lihtne":
                return 1;
            case "keskmine":
                return 2;
            case "raske":
                return 3;
        }
        return 0;
    }
}
