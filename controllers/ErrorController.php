<?php

    class ErrorController{

        public static function _404(){
            echo $GLOBALS['twig']->render('error/404.twig',
            [
                'URL' => URL
            ]
            
        );
        }

        public static function _403(){
            echo $GLOBALS['twig']->render('error/403.twig',
            [
                'URL' => URL
            ]
            
        );
        }

        public static function _500(){
            echo $GLOBALS['twig']->render('error/500.twig',
            [
                'URL' => URL
            ]
            
        );
        }


    }   
?>    