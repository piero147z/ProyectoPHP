<?php

require_once 'vendor/autoload.php';


require_once 'models/User.php';

    class UsersController{

        /**
         * 
         */
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('templates');
            $twig = new \Twig\Environment($loader);
            $user = new User();
            echo $GLOBALS['twig']->render(
                'users/index.twig', 
                ['users' => $user->findAll()]
            );
        }

        /**
         * 
         */
        public function create(){
            echo $GLOBALS['twig']->render(
                'users/create.twig'
            );
        }

        /**
         * 
         */
        public function show(){
            $user = new User();
            echo $GLOBALS['twig']->render(
                'users/show.twig', 
                ['user' => $user->findById($_GET['id'])]
            );
        }

        /**
         * 
         */
        public function edit(){
            $user = new User();
            echo $GLOBALS['twig']->render(
                'users/edit.twig', 
                ['user' => $user->findById($_GET['id'])]
            );
        }

        /**
         * 
         */
        public function save(){
            $user = new User();
            $user->setNombre($_POST['nombre']);
            $user->setApellidos($_POST['apellidos']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->save($user);
            header("Location: http://localhost/proyectos/2DAW%20-%20DWES%20-%20PHP/09%20-%20controladores/?controller=users&action=index");
        }

        /**
         * 
         */
        public function update(){
            $user = new User();
            $user->setId($_POST['id']);
            $user->setNombre($_POST['nombre']);
            $user->setApellidos($_POST['apellidos']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->update();
            header("Location: http://localhost/proyectos/2DAW%20-%20DWES%20-%20PHP/09%20-%20controladores/?controller=users&action=index");
        }
        /**
         * 
         */
        public function delete(){
            $user = new User();
            $user->delete($_GET['id']);
            header("Location: http://localhost/proyectos/2DAW%20-%20DWES%20-%20PHP/09%20-%20controladores/?controller=users&action=index");
        }

    }
?>