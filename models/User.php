<?php

    require 'config/Database.php';
    require 'Model.php';

    class User implements Model{
        private $id;
        private $nombre;
        private $email;
        private $password;


        public function __construct(){

        }

        function getId() {
            return $this->id;
        }

        function getNombre() {
            return $this->nombre;
        }

        function getEmail() {
            return $this->email;
        }
    
        function getPassword() {
            return $this->password;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        function setEmail($email) {
            $this->email = $email;
        }
    
        function setPassword($password) {
            $this->password = $password;
        }


        public function findAll(){
            $db = Database::conectar();
            $findAll = $db->query("SELECT * FROM users;");
            return $findAll;

        }


        public function findById(){
            $db = Database::conectar();
            return $db->query("SELECT * FROM users WHERE id=$this->id")->fetch_object();


        }


        public function save(){
            $db = Database::conectar();
            if($this->password != null){
                $save = $db->query("INSERT INTO users (nombre, email, password) VALUES ('$this->nombre', '$this->email', '$this->password')");
            }

        }


        public function update(){
            $db = Database::conectar();
            if($this->password != null){
                $update = $db->query("UPDATE users SET nombre='$this->nombre', email='$this->email', password='$this->password' WHERE id=$this->id");
            }else{
                $update = $db->query("UPDATE users SET nombre='$this->nombre', email='$this->email' WHERE id=$this->id");
            }

        }


        public function delete(){
            $db = Database::conectar();
            $delete = $db->query("DELETE FROM users WHERE id=$this->id");

        }
        public function login(){

            try {
            $db = Database::conectar();
            $sql = "SELECT * FROM users WHERE email= '$this->email'";

            $user = $db->query($sql);

            if ($user && $user->num_rows == 1) {

                $user = $user->fetch_object();
                
                    $verify = password_verify($this->password, $user->password);


                    if ($verify){

                        if($this->isAdmin($user->id)){
                            
                            $_SESSION['admin'] = true;
                        }
                        return $user;
                    }else{
                        return false;
                    }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        }

        public static function isAdmin($id){
            $db = Database::conectar();
            $tipo = $db->query("SELECT rol_id FROM users_has_rol WHERE user_id=$id")->fetch_object();
            if($tipo->rol_id == 1){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>