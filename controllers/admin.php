<?php 
        class Admin extends ControllerConfig {
            public function __construct() {
                parent::__construct();
                $this->model = $this->loadModel("admin");
            }
            // search in database for all user and return it to display it to admin dashboard
            public function get() {
                $users = $this->model->loadUser();
                $this->view->users = $users;
                $this->view->render("admin/dashboard");
            }
            // this function responsable for pass data to model that will add user to database
            public function adduser() {
                if (isset($_POST['addfirstname'])) {
                    return $this->model->registerUser($_POST);
                }
            }

            // for deleting a user
            public function delete() {
                if(isset($_POST['id'])) {
                    return $this->model->deleteUser($_POST);
                }
            }

            // for updating user
            public function update() {
                return $this->model->updateUser($_POST);
            }
        }
    ?>