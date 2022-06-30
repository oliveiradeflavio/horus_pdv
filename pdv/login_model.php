<?php

    class Login{
        private $id_usuario;
        private $cpf_usuario;
        private $nome_usuario;
        private $username_usuario;
        private $password_usuario;
        private $email_usuario;
        private $foto_usuario;
        private $perfil_usuario;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }

    }

?>