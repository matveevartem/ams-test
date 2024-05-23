<?php

namespace App\Presentation\Http\Router;

class Router
{
    private static function handle($method, $path, $controller): void
    {
        $pattern = "@^" .
            preg_replace(
                '/\\\:[a-zA-Z0-9\_\-]+/',
                '([a-zA-Z0-9\-\_]+)',
                preg_quote($path)
            ) . "$@D";
        $matches = [];

        if (
            $_SERVER['REQUEST_METHOD'] == $method && preg_match($pattern, $_SERVER['REQUEST_URI'], $matches)
        ) {
            array_shift($matches);
            call_user_func_array([new $controller[0], $controller[1]], $matches);
        }
    }

    public static function get($path, $controller): void
    {
        self::handle('GET', $path, $controller);
    }

    public static function post($path, $controller): void
    {
        self::handle('POST', $path, $controller);
    }

    public static function delete($path, $controller): void
    {
        self::handle('DELETE', $path, $controller);
    }
}
