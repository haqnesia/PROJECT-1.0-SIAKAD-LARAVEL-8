<?php

if (!function_exists('html_normalize')) {
    function html_normalize($result)
    {
        return trim(preg_replace("/[\r\n\t]+/", '', $result));
    }
}