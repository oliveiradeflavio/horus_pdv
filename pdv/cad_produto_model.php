<?php

    class CadProduto{
        private $id_produto;
        private $foto_produto;
        private $nome_produto;
        private $codigo_produto;
        private $descricao_produto;
        private $quantidade_produto;
        private $preco_unitario_produto;
        private $preco_venda_produto;
        private $preco_total_produto;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }
    }
?>