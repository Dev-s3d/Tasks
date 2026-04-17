<?php

class clsPath
{
    private static $Domain = "http://localhost/";
    // المسار الأساسي للمشروع
    public static function root()
    {
        return self::$Domain . 'tasks';
    }

    public static function assets()
    {
        return self::root() . '/assets/';
    }

    public static function auth()
    {
        return self::root() . '/auth/';
    }

    public static function classes()
    {
        return self::root() . '/classes/';
    }

    public static function includes()
    {
        return self::root() . '/includes/';
    }

    public static function tasks()
    {
        return self::root() . '/tasks/';
    }

    public static function public()
    {
        return self::root() . '/index.php';
    }
}
