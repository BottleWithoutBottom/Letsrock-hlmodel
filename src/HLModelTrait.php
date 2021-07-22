<?php

namespace Bitrock;

trait HLModelTrait
{
    public static function getDefaultOrder()
    {
        return ['UF_SORT' => 'ASC'];
    }


    public static function getActiveFilter()
    {
        return ['UF_ACTIVE' => 1];
    }

    public static function getTimeCompatible($timeInSeconds)
    {
        global $DB;
        return date($DB->DateFormatToPHP(\CSite::GetDateFormat("FULL")), $timeInSeconds);
    }
}