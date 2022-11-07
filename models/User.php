<?php

    require 'config/Database.php';
    require 'Model.php';

    class User implements Model{
        private $id;
        private $email;
        private $password;


        public function __construct(){

        }

        function getId() {
            return $this->id;
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

        function setEmail($email) {
            $this->email = $email;
        }
    
        function setPassword($password) {
            $this->password = password_hash($password, PASSWORD_BCRYPT, ['cont' => 4]) ;
        }


        public function findAll(){
            $db = Database::conectar();
            return $db->query("SELECT * FROM users;");

            
        }


        public function findById(){
            $db = Database::conectar();
            return $db->query("SELECT * FROM users WHERE id=".$this->id);


        }


        public function save(){
            $db = Database::conectar();
            $db->query("INSERT INTO users (email, password) 
            VALUES ('$this->email','$this->password')");

        }


        public function update(){
            $db = Database::conectar();
            $db->query("UPDATE users SET email='$this->email', password='$this->password'");

        }


        public function delete(){
            $db = Database::conectar();
            $db->query("DELETE FROM users WHERE id=$this->id");

        }

    }

?>