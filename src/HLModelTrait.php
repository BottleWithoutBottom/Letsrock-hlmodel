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
}