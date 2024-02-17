<?php

    class LoginService{
        private $conexao;
        private $login;

        public function __construct(Conexao $conexao, Login $login){
            $this->conexao = $conexao->conectar();
            $this->login = $login;
        }

        public function inserir(){
            $query = "INSERT INTO tb_usuarios (cpf_usuario, nome_usuario, email_usuario, username_usuario, password_usuario, foto_usuario) VALUES (:cpf, :nome, :email, :usuario, :senha, :foto)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cpf', $this->login->__get('cpf'));
            $stmt->bindValue(':nome', $this->login->__get('nome'));
            $stmt->bindValue(':email', $this->login->__get('email'));
            $stmt->bindValue(':usuario', $this->login->__get('usuario'));
            $stmt->bindValue(':senha', $this->login->__get('senha'));
            $stmt->bindValue(':foto', $this->login->__get('foto'));
            $stmt->execute();
        }
    
        public function consultaUsuario(){
            $query = "SELECT * FROM tb_usuarios WHERE cpf_usuario = :cpf OR username_usuario = :usuario";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cpf', $this->login->__get('cpf'));
            $stmt->bindValue(':usuario', $this->login->__get('usuario'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
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

        public function excluirUsuario(){
            $query = "DELETE FROM tb_usuarios WHERE id_usuario = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->login->__get('id_usuario'));
            $stmt->execute();            
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

        public function alteraPermissaoUsuario(){
                
                $query = "update tb_usuarios set perfil_usuario = :permissao where id_usuario = :id";
                try{
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':permissao', $this->login->__get('perfil_usuario'));
                $stmt->bindValue(':id', $this->login->__get('id_usuario'));
                $stmt->execute();
                }
                catch(PDOException $e){
                    echo "PDOException: " .$e->getMessage();
                }
        }

        public function novaSenhaUsuario(){

            $query = "update tb_usuarios set password_usuario = :senha where id_usuario = :id";
            try{
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':senha', $this->login->__get('nova_senha'));
            $stmt->bindValue(':id', $this->login->__get('id_usuario'));
            $stmt->execute();
            }
            catch(PDOException $e){
                echo "PDOException: " .$e->getMessage();
            }           
        }
       
    }
