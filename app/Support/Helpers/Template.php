<?php

namespace App\Support\Helpers;

class Template
{
    /**
     * Print Active class
     *
     * @param  string|array $route    The route of link
     * @param  string       $active   Class when URL matches Route
     * @param  string       $inactive Class when no match (Default class)
     * @return string
     */
    public static function active_class(string|array $route, string $active = 'active', string $inactive = '')
    {
        if (is_array($route)) {
            $link = route(...$route);
        } else {
            $link = route($route);
        }

        $page = url()->current();

        $match = $link === $page;

        $class = $match ? $active : $inactive;

        return empty($class) ? "" : " {$class} ";
    }

    /**
     * Print active class on specific route
     *
     * @param  string|array $route
     * @param  string       $active
     * @param  string       $inactive
     * @return string
     */
    public static function active_class_route(string|array $route, string $active = 'active', string $inactive = '')
    {
        $match = request()->routeIs($route);

        $class = $match ? $active : $inactive;

        return empty($class) ? "" : " {$class} ";
    }
}
