<?php
    class Database{
        public static function conectar(){
            //mysql('localhost',usuario,password,basededatos)
            $conexion = new mysqli("localhost","root","","pruebaphp");
            $conexion->query("SET NAMES 'utf8'");

            return $conexion;
        }
    }

?>