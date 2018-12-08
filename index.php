<?php

function __autoload($class){
    $file = "classes/$class.php";
    if (file_exists ( $file)) {
        require_once ($file);
    }
    $file = "controllers/$class.php";
    if (file_exists ( $file)) {
        require_once ($file);
    }
}

$routing = new Routing();