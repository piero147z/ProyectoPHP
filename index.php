<?php

    require_once 'config/Parameters.php';
    require_once 'vendor/autoload.php';

    include 'controllers/UsersController.php';
    include 'controllers/AuthController.php';
    include 'controllers/IndexController.php';
    include 'controllers/ErrorController.php';
    include 'controllers/CarritoController.php';

    session_start();
    
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);



        if (isset($_GET['controller'])) {
            
            $controller = ucfirst($_GET['controller']).'Controller';
            

            if (class_exists($controller)) {
                $controller_object = new $controller();
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    $controller_object->$action();
                }
        
            }else {

                ErrorController::_404();
            }
        }else {
            # code...
            //$usersController = new UsersController();
            //$usersController->index();

            //echo $twig->render('index.twig');
            //IndexController::index();

            $controller_default = controller_default;
            $action_default = action_default;
            $controller = new $controller_default();
            $controller->$action_default();

        }

?>