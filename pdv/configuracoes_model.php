<?php

    class Configuracoes{
        private $id_configuracoes;
        private $senha_master_configuracoes;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }

    }


?>