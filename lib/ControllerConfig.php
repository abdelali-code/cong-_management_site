<?php 
    class ControllerConfig {
        public function __construct() {
            $this->view = new ViewsConfig();
        }
        // load the models
        public function loadModel($name) {
            $path = "models/".$name."Model.php";
            if (file_exists($path)) {
                require_once($path);
                $modelName = ucfirst($name)."Model";
                return $this->model = new $modelName();
            }else {
                return false;
            }
        }
    }
?>