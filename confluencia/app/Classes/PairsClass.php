<?php

namespace App\Classes;

use App\Models\Pairs;

class PairsClass
{
    public static $LIST_ONLY = 1;
    public static $FULL_LIST = 2;

    public function getList($type)
    {
        return Pairs::all();
    }

    public function getListOtc($type)
    {
        echo "Will get list by $type";
    }

    public function getListNormal($type)
    {
        echo "Will get list by $type";
    }

    public function getName($type)
    {
        echo "Will get list by $type";
    }

    public function getPayoutList($type)
    {
        echo "Will get list by $type";
    }

    public function getOpenList($type)
    {
        echo "Will get list by $type";
    }
}

?>