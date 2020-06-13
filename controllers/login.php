<?php 
    class Login extends ControllerConfig {
        public function __construct() {
            parent::__construct();
            $this->model = $this->loadModel("login");
        }

        // public function get() {
            
        // }
        public function login() {
            if (isset($_POST["submit"])) {
                $this->model->login($_POST);
            }
            $this->view->render("login/login");
        }
    }
?>