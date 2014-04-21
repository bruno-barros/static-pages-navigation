<?php
/**
 * paths helpers
 *
 * @author Bruno Barros <bruno@brunobarros.com>
 * @package Helpers
 */

if(! function_exists('site_url'))
{
    function site_url($page = '')
    {
//        $config['base_url_complemento'] = str_replace('//', '/', dirname($_SERVER['SCRIPT_NAME']) . '/');

        $base_url = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';
        $base_url .= $_SERVER['HTTP_HOST'] . str_replace('//', '/', dirname($_SERVER['SCRIPT_NAME']) . '/');
        return $base_url . $page;
    }
}