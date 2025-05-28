<?php
function dd($value){

    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    
    die;
}

// echo $_SERVER['REQUEST_URI'];

function urlIs($path){
    return $_SERVER['REQUEST_URI'] === $path;
}