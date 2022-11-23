<?php

    class AuthController{
        
        
        public function login(){
            echo $GLOBALS['twig']->render('auth/login.twig',
            [
                'URL' => URL
            ]
            );
        }

        public function home(){
            if(isset($_SESSION['identity'])){
                echo $GLOBALS['twig']->render('home.twig',
            [
                'identity' => $_SESSION['identity'],
                        'URL' => URL
            ]
        );
            }else{
                header('Location: '.URL.'controller=auth&action=login');
            }
        }

       
        public function logout(){
            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
            }
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
            header('Location: '.URL.'controller=auth&action=login');
        }

        public function doLogin(){


            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user_ok = $user->login();

            var_dump($user_ok);
                exit();

            if($user_ok && is_object($user_ok)){
                $_SESSION['identity'] = $user_ok;

                if(isset($_SESSION['admin'])){
                    header('Location: '.URL.'controller=auth&action=home');
                }else{
                    header('Location: '.URL.'controller=auth&action=welcome');
                }
             }else{
                header('Location: '.URL.'controller=auth&action=login');
             }

        }

        public static function welcome(){
            if(isset($_SESSION['identity'])){
                $producto = new Producto();
                $categoria = new Categoria();
                echo $GLOBALS['twig']->render('welcome.twig', 
                        [
                            'productos' => $producto->findAll(),
                            'categorias' => $categoria->findAll(),
                            'identity' => $_SESSION['identity'],
                            'URL' => URL
                        ]
                    );
            }else{
                header('Location: '.URL.'controller=index&action=index');
            }
        }

    }

?>