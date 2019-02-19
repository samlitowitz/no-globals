<?php

$GLOBALS['global_write'] = true;
if ($GLOBALS['global_write']) {
}

function f()
{
    $GLOBALS['local_write'] = true;
    if ($GLOBALS['local_write']) {
    }
}
