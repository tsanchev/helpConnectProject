<?php


/**
 * Debug function
 * d($var);
 */
function d($var,$caller=null)
{
    if(!isset($caller)){
        $tmp = debug_backtrace(1);
        $caller = array_shift($tmp);
    }
    echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
    echo '<pre>';
    yii\helpers\VarDumper::dump($var, 10, true);
    echo '</pre>';
}

/**
 * Debug function with die() after
 * dd($var);
 */
function dd($var)
{
    $tmp = debug_backtrace(1);
    $caller = array_shift($tmp);
    d($var,$caller);
    die();
}

