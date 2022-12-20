<?php

function activeClassMethode(){
    $CI = & get_instance();

    $class = $CI->router->fetch_class();
    $method = $CI->router->fetch_method();

    return array(
        'class' => $class,
        'methode' => $method
    );
}

?>