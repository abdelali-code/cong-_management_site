<?php 
    class Login extends ControllerConfig {
        public function __construct() {
            parent::__construct();
            $this->model = $this->loadModel("login");
        }

        // public function get() {
            
        // }
        public function login() {
             // if there already a session which mean user still log in 
             if (isset($_SESSION['userid'])) {
                if ($_SESSION['type'] == "EM") {
                    header('Location:'.BASE_URL.'/home');
                }
                elseif ($_SESSION['type'] == "AD") {
                    header('Location:'.BASE_URL.'/admin');
                }
                elseif ($_SESSION['type'] == "RH") {
                    header('Location:'.BASE_URL.'/rhumain');
                }
            }
            // user not log in yet 
            if (isset($_POST["submit"])) {
                $this->model->login($_POST);
            }
            $this->view->render("login/login");
        }
        // for logout user from site
        public function logout() {
            Session::destroy();
            echo "logout";
            header('Location:'.BASE_URL);
        }
    }
?>