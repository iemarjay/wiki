<?php


namespace App\Classes;


use Pecee\Http\Url;
use Pecee\SimpleRouter\SimpleRouter as Router;

class Helper
{
    public static function view($name, $data = []): void
    {
        if (!file_exists(__DIR__. "/../../views/$name.phtml")) {
            die('view does not exist');
        }

        require_once __DIR__. "/../../views/$name.phtml";
    }

    public static function config($key = null)
    {
        $config = include __DIR__. '/../../config.php';

        if (!$key) {
            return $config;
        }
        return $config[$key] ?? null;
    }

    public static function url($path = '/'): string
    {
        return '//'. $_SERVER['HTTP_HOST']. '/'. ltrim($path, '/');
    }

    public static function route(?string $name = null, $parameters = null, ?array $getParams = null): Url
    {
        return Router::getUrl($name, $parameters, $getParams);
    }
}
