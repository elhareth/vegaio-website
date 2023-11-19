<?php

use App\Support\Helpers\Template as TemplateHelper;

/**
 * Active class on route
 */
if (!function_exists('active_class_route'))
{
    /**
     * Print active class on route match
     *
     * @param  string|array $route
     * @param  string       $active
     * @param  string       $inactive
     * @return string
     */
    function active_class_route(
        string|array $route,
        string $active = 'active',
        string $inactive = ''
    )
    {
        return TemplateHelper::active_class_route($route, $active, $inactive);
    }
}

/**
 * label file size
 */
if (!function_exists('labelFileSize'))
{
    /**
     * Pretty print file size
     *
     * @param  int|string $size
     * @return string
     */
    function labelFileSize(int|string $size)
    {
        throw_if(!is_numeric($size), 'TypeError');

        $B = intval($size);
        $K = round($B / 1024, 2);
        $M = round($K / 1024, 2);
        $G = round($M / 1024, 2);

        if ($G > 1) {
            return "{$G}GB";
        } elseif ($M > 1) {
            return "{$M}MB";
        } elseif ($K > 1) {
            return "{$K}KB";
        } else {
            return "{$B}Bytes";
        }

    }
}

/**
 * Slugify
 */
if (!function_exists('vega_slugify')) {
    /**
     * Create a slug
     *
     * @param  string $string
     * @param  string $sep
     * @return string
     */
    function vega_slugify($string, $sep)
    {
        $string = strip_tags($string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = preg_replace('/\p{M}/', '', $string);
        $string = str_replace(' ', $sep, $string);
        $string = preg_replace("/".$sep."{2,}/", $sep, $string);
        $string = trim($string);
        $string = trim($string, $sep);
        $string = strtolower($string);
        $string = urlencode($string);

        return $string;
    }
}
