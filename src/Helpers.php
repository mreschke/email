<?php

function dump()
{
    array_map(function ($items) {
        var_dump($items);
    }, func_get_args());
}

function dd()
{
    array_map(function ($items) {
        var_dump($items);
    }, func_get_args());
    exit();
}