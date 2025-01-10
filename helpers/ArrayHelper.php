<?php

namespace app\helpers;


class ArrayHelper
{
    public static function toJson($weathers)
    {
        $arrayRepresentations = array_map(function ($weather) {
            return $weather->toArrayCustom();
        }, $weathers);

// Преобразование в JSON все работает исправно
        return json_encode($arrayRepresentations, JSON_PRETTY_PRINT);
    }
}