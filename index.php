<?php

//require_once 'vendor/autoload.php';

//$loader = new \Twig\Loader\FilesystemLoader('templates');
//$twig = new \Twig\Environment($loader);

// echo $twig->render('plantilla.twig');

    //require_once 'models/User.php';

    //$user = new User();
    //$user->setId(1);

    //print_r ($user->findAll());

   /* echo $twig->render(
        'users/index.twig', 
        [
            'users' => $user->findAll(),
        ]
    );*/

    if (isset($_GET['controller'])) {
        $controller = ucfirst($_GET['controller']).'Controller';


        if (class_exists($controller)) {
            $controller_object = new $controller();
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                $controller_object->$action();
            }
        }
    
    }else {
        # code...
    }

?>