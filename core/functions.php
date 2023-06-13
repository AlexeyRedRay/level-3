<?php

function render($tpl, $content) {
    if(file_exists('views/'.$tpl.'.php')) {
        ob_start();
        //extract($vars);

        require 'views/'.$tpl.'.php';
        return ob_get_clean();
    }
}