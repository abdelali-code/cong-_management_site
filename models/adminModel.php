<?php 
    class AdminModel extends Database {
        public function __construct() {
            // Session::init();
            parent :: __construct();
        }
        public function registerUser($data) 
        {

            $errMess = [];
            // validate the data

            /*******************  Nom validation ******************/
            $nameLength = strlen($data['addfirstname']);
            if (!empty($data['addfirstname']) && ($nameLength < 60 && $nameLength >= 3) && (ctype_alpha($data['addfirstname']))) {
                $name = $data['addfirstname'];
            } else {
                $errMess['firstnameErr'] = "name Must be all character and between 2 and 60";
            }

            /*********************** prénom validation ************************/
            $lastNameLength = strlen($data['addlastname']);
            if (!empty($data['addlastname']) && ($lastNameLength < 60 && $lastNameLength >= 3) && (ctype_alpha($data['addlastname']))) {
                $prenom = $data['addlastname'];
            } else {
                $errMess['lastnameErr'] = "Prénom Must be all character and between 2 and 60";
            }
            
            // email validation
            if(filter_var($data['addemail'], FILTER_VALIDATE_EMAIL)) {
                //Valid email!
                $email = $data['addemail'];
            } else {
                $errMess['emailErr'] = "Email is not correct";
            }

            //    telephone number validation
            $tel = str_replace(" ", "", $data['addtelnum']);
            $tel = str_replace("-", "", $tel);
            $telLength = strlen($tel);
            if (ctype_digit($tel) && ($telLength >= 9 && $telLength<= 10)) {
                $tel = $tel;
            } else {
                $errMess['telnumErr'] = "tel number should contient only number";
            }

            // CIN validation 
            if (!empty($data['addcin']) && ctype_alnum($data['addcin']) && (strlen($data['addcin']) <= 12) ) {
                $cin = $data['addcin'];
            } else {
                $errMess['cinErr'] = "Not Valid CIN";
            }

            // grade validation 
            if (!empty($data['addgrade']) && ctype_alnum($data['addgrade']) && (strlen($data['addgrade']) < 20) ) {
                $grade = $data['addgrade'];
            } else {
                $errMess['gradeErr'] = "should all be all caracter and less than 20 character";
            }

            // service validation 
            if (!empty($data['addsevice']) && ctype_alnum($data['addgrade']) && (strlen($data['addgrade']) < 20)) {
                $service = $data['addsevice'];
            } else {
                $errMess['serviceErr'] = "should all be all caracter and less than 20 charactery";
            }


            // search if exist any user with this email or CIN entred
            // $query = "SELECT * FROM users WHERE CIN = :cin OR email = :email";
            // $stm = $this->db->prepare($query);
            // $stm->execute(array(":cin" =>$cin, "email"=>$email));
           
            // if ($stmt->rowCount() > 0) {
            //     $errMess['userExist'] =  "user with this email or CIN already exist";
            //     header("Content-type:application/json"); 
            //     echo json_encode($errMess);
            // }
            

            // dont forget password;
            // if there is no error store this value in database
            // but first generate a random password
            if (empty($errMess)) {
                // you should avoid this after because it take a lot of time to generate a random password;
                // search after on a better solutions;
                $password = md5(1000, 12000);
                $password = password_hash($password, PASSWORD_BCRYPT);
                $password = substr($password, 0, 20);

                // file to store password to remove
                // it should be removed just for testing purpose
                $passFile = fopen("newfile.csv", "a") or die("Unable to open file!");
                $text = "cin $cin || password is :  $password \n";
                fwrite($passFile, $text);
                fclose($passFile);
                // file to remove;

                

                // encrypt password
                $password = password_hash($password, PASSWORD_BCRYPT);
                
                // insert into database
                $query = "INSERT INTO users(firstName, lastName, CIN, tel, email, grade, service, password)
                            VALUES(:name, :prenom, :cin, :tel, :email, :grade, :service, :password)";
                $stm = $this->db->prepare($query);
                // if everythig alright
                if ($stm) {
                    $stm->execute( array ( ":name" => $name, ":prenom" => $prenom, ":cin" => $cin, ":tel" => $tel, ":email" => $email, ":grade" => $grade, ":service" => $service, ":password" => $password));
                    // render the inserted row to front end to display it
                    $getUser = "SELECT firstName, lastName, email, service, grade, CIN FROM users WHERE CIN = :cin";
                    $prepa = $this->db->prepare($getUser);
                    $prepa->execute(array (":cin" => $cin));
                    $row = $prepa->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        header("Content-type:application/json");
                        echo json_encode($row);
                    }
                }else {
                    echo "something goes wrong";
                }
            } else {
                // it'q mean this is error;
                // send those error to view to handle it;
                header("Content-type:application/json"); 
                echo json_encode($errMess);
            }   
        }

        // to select users from database 
        public function loadUser() {
                $query = "SELECT * from users WHERE type = 'EM' ";
                $stm = $this->db->prepare($query);
                $stm->execute();

                // check if number of row does not equal 1
                $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
                if ($rows) {
                    return $rows;
                }
        }

        // delete users
        public function deleteUser($data) {
            $query = "DELETE FROM users WHERE CIN = :id";
            $stm = $this->db->prepare($query);
            $stm->execute( array(":id" =>$data['id']));

            // if query excute successufuly 
            if ($stm) {
                return $stm;
            }
        }
        public function updateUser($data) {
            $query = "UPDATE users set firstName=:firstname, lastName=:lastname, email=:email, service=:service, grade=:grade WHERE CIN=:id and type = 'EM'";
            $stm = $this->db->prepare($query);
            $stm->execute(array(":firstname" =>$data['upfirstname'], ":lastname" =>$data['uplastname'], ":email" =>$data['upemail'], ":service" =>$data['upservice'], "grade" =>$data['upgrade'],":id" =>$data['id'] ));

            if ($stm) {
                $getUser = "SELECT firstName, lastName, email, service, grade   FROM users WHERE CIN = :id";
                $prepa = $this->db->prepare($getUser);
                $prepa->execute(array (":id" => $data['id']));

                $row = $prepa->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    header("Content-type:application/json");
                    echo json_encode($row);
                }
            }
        }
    }

?>