<?php 
    class Dispatcher {
        public function __construct() 
        {
            if (isset($_GET['url'])) 
            {
                $url = $_GET['url'];
                $url = explode('/', $url); 
            }

            // require user to sing in
            if (empty($url))
             {
                // require the log in controllers;
                require_once('controllers/login.php');
                return (new Login())->login();
            }
            
            // if the url is not like format of controllers / action / params;
            elseif (count($url) < 3) 
            {
                // user enter the valid format
                $fileName = "controllers/$url[0].php";
                if (file_exists($fileName))
                {
                    require_once($fileName);
                    
                    // make the first letters uppercase (class Name convention);
                    $controller = ucfirst($url[0]);
                    $controllerClass = new $controller();
                    // if there is no action
                    if (empty($url[1])) {
                        return $controllerClass->get();
                    }
                    $action_name = isset($url[1]) ? $url[1]:NULL;
                    // if there is an action in the url;
                    if ($action_name && (method_exists($controllerClass, $url[1]))) 
                    {
                        // if there is an params in the url;
                        if (empty($url[2])) 
                        {
                            return $controllerClass->{$url[1]}();
                        }
                        else 
                        {
                            return $controllerClass->{$url[1]}($url[2]);
                        }
                    }
                    
                }
            }
            else  
            {
                include_once('views/404.php');
            } 
        }

    }

?>