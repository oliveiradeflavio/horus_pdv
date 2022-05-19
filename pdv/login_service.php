<?php

    class LoginService{
        private $conexao;
        private $login;

        public function __construct(Conexao $conexao, Login $login){
            $this->conexao = $conexao->conectar();
            $this->login = $login;
        }

        public function inserir(){
            $query = "INSERT INTO tb_usuarios (cpf_usuario, nome_usuario, email_usuario, username_usuario, password_usuario) VALUES (:cpf, :nome, :email, :usuario, :senha)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cpf', $this->login->__get('cpf'));
            $stmt->bindValue(':nome', $this->login->__get('nome'));
            $stmt->bindValue(':email', $this->login->__get('email'));
            $stmt->bindValue(':usuario', $this->login->__get('usuario'));
            $stmt->bindValue(':senha', $this->login->__get('senha'));
            $stmt->execute();
        }
    

        public function recuperar(){

            $query = "select * from tb_usuarios where username_usuario = :usuario and password_usuario = :senha";
            try{
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':usuario', $this->login->__get('usuario'));
            $stmt->bindValue(':senha', $this->login->__get('senha'));
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo "PDOException: " .$e->getMessage();
            }
        }

        public function atualizar(){

            $query = "update tb_usuarios set nome_usuario = :nome, email_usuario = :email, foto_usuario = :foto where id_usuario = :id";
            try{
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->login->__get('nome'));
            $stmt->bindValue(':email', $this->login->__get('email'));
            $stmt->bindValue(':foto', $this->login->__get('foto'));
            $stmt->bindValue(':id', $this->login->__get('id'));
            $stmt->execute();
            }
            catch(PDOException $e){
                echo "PDOException: " .$e->getMessage();
            }
        }

        public function atualizarSenha(){

            $query = "update tb_usuarios set nome_usuario = :nome, email_usuario = :email, password_usuario = :senha, foto_usuario = :foto where id_usuario = :id";
            try{
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->login->__get('nome'));
            $stmt->bindValue(':email', $this->login->__get('email'));
            $stmt->bindValue(':senha', $this->login->__get('senha'));
            $stmt->bindValue(':foto', $this->login->__get('foto'));
            $stmt->bindValue(':id', $this->login->__get('id'));
            $stmt->execute();
            }
            catch(PDOException $e){
                echo "PDOException: " .$e->getMessage();
            }
           
        }
       
    }


?>