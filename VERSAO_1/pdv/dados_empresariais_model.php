<?php

    class DadosEmpresariaisModel{
        private $id_dados_empresariais;
        private $cnpj_dados_empresariais;
        private $nome_empresa_dados_empresariais;
        private $cep_dados_empresariais;
        private $estado_dados_empresariais;
        private $cidade_dados_empresariais;
        private $endereco_dados_empresariais; 
        private $numero_dados_empresariais;
        private $bairro_dados_empresariais;
        private $telefone_dados_empresariais;
        private $celular_dados_empresariais;
        private $email_dados_empresariais;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }
    }
?>