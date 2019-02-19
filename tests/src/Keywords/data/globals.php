<?php

global $globalWrite;
$globalWrite = true;
if ($globalWrite) {}

function f()
{
    global $globalWrite;
    $globalWrite = true;
    if ($globalWrite) {}
}
