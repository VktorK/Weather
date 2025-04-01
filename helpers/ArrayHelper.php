<?php

namespace app\helpers;


class ArrayHelper
{
    public static function toJson($arrays)
    {
        $arrayRepresentations = array_map(function ($model) {
            return $model->toArrayCustom();
        }, $arrays);

        return json_encode($arrayRepresentations, JSON_PRETTY_PRINT);
    }
}