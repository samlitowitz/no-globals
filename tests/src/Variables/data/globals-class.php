<?php

namespace GlobalsClass;

class C
{
    public function __construct()
    {
        $GLOBALS['class_write'] = true;
        if ($GLOBALS['class_write']) {
        }
    }
}