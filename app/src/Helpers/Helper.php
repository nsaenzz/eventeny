<?php

namespace App\Helpers;

class Helper{
    
    public static function camelToSnake($camelCase) { 
        $pattern = '/(?<=\\w)(?=[A-Z])|(?<=[a-z])(?=[0-9])/'; 
        $snakeCase = preg_replace($pattern, '_', $camelCase); 
        return strtolower($snakeCase); 
    }

    public static function snakeToTitle($snakeCase) {
        return ucwords(strtolower(str_replace('_', ' ', $snakeCase)));  
    }

}