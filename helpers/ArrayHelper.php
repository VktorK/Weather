<?php

namespace app\helpers;


class ArrayHelper
{
    public static function toJson($arrays)
    {
//        var_dump($arrays);die();
        $arrayRepresentations = array_map(function ($model) {
            return $model->toArrayCustom();
        }, $arrays);

// Преобразование в JSON все работает исправно
        return json_encode($arrayRepresentations, JSON_PRETTY_PRINT);
    }
}