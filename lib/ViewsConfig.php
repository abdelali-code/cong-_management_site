<?php 
    class ViewsConfig {
        public function __construct() {
            
        }
        public function render($fileName) {
            require("views/".$fileName.".php");
        } 
    }
?>