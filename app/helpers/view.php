<?php


function view($path, $args)
{ 
    $templates = new League\Plates\Engine(__DIR__ . '/../../views');
    echo $templates->render($path, $args);
}