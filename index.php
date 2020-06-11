<?php 
    require_once('lib/config.php');

    function my_autoloader($class) {
        require 'lib/'.$class.'.php';
    }
    spl_autoload_register('my_autoloader');

    
    $app = new Dispatcher();
    
?>