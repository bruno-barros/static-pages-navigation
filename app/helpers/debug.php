<?php
/**
 * debug helpers
 *
 * @author Bruno Barros <bruno@brunobarros.com>
 * @package Helpers
 */

if (!function_exists('dd'))
{

    function dd($var)
    {
        echo '<pre>';
        var_dump($var);
        exit;
    }
}

if (!function_exists('d'))
{

    function d($var)
    {
        echo '<pre>';
        var_dump($var);
    }
}