<?php

    class Conexao{
        private $host = 'localhost';
        private $dbname = 'pdv_horus';
        private $user = 'root';
        private $pass = 'foliveira';

        public function conectar(){
            try{
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
                    "$this->user",
                    "$this->pass"
                );
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexao;

            }catch(PDOException $e){
                echo "PDOException: " .$e->getMessage();
            
            }catch(Exception $e){
                echo "Exception: " .$e->getMessage();
            
            }catch(Error $e){
                echo "Erro: " .$e->getMessage();
            }
        }
    }


?>