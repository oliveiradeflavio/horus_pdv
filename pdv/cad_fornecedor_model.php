<?php

    class CadFornecedor{
        private $id_fornecedor;
        private $cnpj_fornecedor;
        private $razao_social_fornecedor;
        private $nome_fantasia_fornecedor;
        private $cep_fornecedor;
        private $estado_fornecedor;
        private $cidade_fornecedor;
        private $endereco_fornecedor;
        private $numero_fornecedor;
        private $complemento_fornecedor;
        private $bairro_fornecedor;
        private $telefone_fornecedor;
        private $celular_fornecedor;
        private $email_fornecedor;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }

    }


?>