<?php 
    class LoginModel extends Database {
        public function __construct() {
            Session::init();
            parent :: __construct();
        }
        public function login($data) {
            $email = $data['email'];
            $password = $data['password'];

            $query = "SELECT * from users WHERE email = :email" ;
            $stm = $this->db->prepare($query);
            $stm->execute( array (":email" => $email));

            // check if number of row does not equal 1
            $rows = $stm->fetch(PDO::FETCH_ASSOC);
            // if ($rows && password_verify($password, $rows['password']))  after hashing the password activate this
            // if ($rows && $password == $rows['password']){
            if ($rows && password_verify($password, $rows['password'])) {
                // start a session
                $_SESSION['type'] = $rows['type'];
                $_SESSION['userid'] = $rows['CIN'];
                $_SESSION['username'] = $rows['firstName'];
                // redirect user to apropriate page
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
            else {
                $message = "error";
                header("Location: ".BASE_URL."/auth?message=".urldecode($message));

            }
        }
    }
?>