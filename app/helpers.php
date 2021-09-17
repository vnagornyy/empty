<?php

use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        exit(1);
    }
}


if (!function_exists('responseJson')) {
    function responseJson($data, $status = 500)
    {
        header("HTTP/1.1 ".$status." ".'OK');
        echo json_encode($data);
        die();
    }
}
