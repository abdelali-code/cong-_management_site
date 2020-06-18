<?php 
    class Dispatcher {
        public function __construct() 
        {
            // extract url 
            if (isset($_GET['url'])) 
            {
                $url = $_GET['url'];
                $url = explode('/', $url); 
            }

            // require user to sing in
            if (empty($url))
             {
                // require the log in controllers;
                // require_once('controllers/auth.php');
                // return (new Auth())->login();
                header('Location:auth');
            }
            
            // if the url is not like format of controllers / action / params;
            // elseif (count($url) < 3) 
            // {
            //     // user enter the valid format
            //     $fileName = "controllers/$url[0].php";
            //     if (file_exists($fileName))
            //     {
            //         require_once($fileName);
                    
            //         // make the first letters uppercase (class Name convention);
            //         $controller = ucfirst($url[0]);
            //         $controllerClass = new $controller();
            //         // if there is no action
            //         if (empty($url[1])) {
            //             return $controllerClass->get();
            //         }
            //         $action_name = isset($url[1]) ? $url[1]:NULL;
            //         // if there is an action in the url;
            //         if ($action_name && (method_exists($controllerClass, $url[1]))) 
            //         {
            //             // if there is an params in the url;
            //             if (empty($url[2])) 
            //             {
            //                 return $controllerClass->{$url[1]}();
            //             }
            //             else 
            //             {
            //                 return $controllerClass->{$url[1]}($url[2]);
            //             }
            //         }
                    
            //     }
            // }
            // else  
            // {
            //     include_once('views/404.php');
            // } 


            // anpther try
            // for employer page
            elseif (count($url) <= 3) {
                // for authenticationcontrollers
                if ($url[0] == "auth") {
                    require("controllers/auth.php");
                    $auth = new Auth();
                    if (empty($url[1])) {
                        return $auth->login();
                    }
                    else if(method_exists($auth, $url[1])) {
                        return $auth->{$url[1]}();
                    }
                    else {
                        include_once('views/404.php');
                    }
                }
                // for home page
                if ($url[0] == "home") {
                    Session::init();
                    if (Session::get('type') == "EM") {
                        require("controllers/home.php");
                        $home = new Home();
                        if (empty($url[1])) {
                            return $home->get();
                        }
                        else if(method_exists($home, $url[1])) {
                            if (empty($url[2])) {
                                return $home->{$url[1]}();
                            }
                            else {
                                return $home->{$url[1]}($url[2]);
                            }
                            
                        }
                        else {
                            include_once('views/404.php'); 
                        }
                    }
                    // not an authorised users
                    else {
                        echo "you are not authorised";
                    }
                }
                // for admin page
                else if($url[0] == "admin") {
                    Session::init();
                    if (Session::get('type') == "AD") {
                        require("controllers/admin.php");
                        $admin = new Admin();
                        if (empty($url[1])) {
                            return $admin->get();
                        }
                        else if(method_exists($admin, $url[1])) {
                            return $admin->{$url[1]}();
                        }
                        else {
                            include_once('views/404.php'); 
                        }
                    }
                    else {
                        echo "you are not authrised";
                    }

                }

                // for rh page
                else if($url[0] == "rhumain") {
                    Session::init();
                    if (Session::get('type') == "RH") {
                        require("controllers/rhumain.php");
                        $rhumain = new Rhumain();
                        if (empty($url[1])) {
                            return $rhumain->get();
                        }
                        else if(method_exists($rhumain, $url[1])) {
                            return $rhumain->{$url[1]}();
                        }
                        else {
                            include_once('views/404.php'); 
                        }
                    }
                    else {
                        echo "you are not authorised";
                    }
                }
                else {
                    include_once('views/404.php');
                }
            }
            else {
                include_once('views/404.php');
            }
        }

    }

?>