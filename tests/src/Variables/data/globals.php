<?php

$GLOBALS['global_write'] = true;
if ($GLOBALS['global_write']) {
}

$GLOBALS['global_nested']['write'] = true;

$a = 0;
$GLOBALS[$a] = 0;

$GLOBALS[$GLOBALS[$a]] = true;

function f()
{
    $GLOBALS['local_write'] = true;
    if ($GLOBALS['local_write']) {
    }
}
