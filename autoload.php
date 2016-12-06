<?php

function autoload($className) {
    $className = str_replace('\\', DS, $className);
    $file = SITE_DIR . DS . $className . '.php' ;

    //echo $file . '<br>';

    if(file_exists($file)) {
        include_once $file;
    }

}

spl_autoload_register('autoload');