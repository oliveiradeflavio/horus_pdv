<?php

    class Venda{
        private $id_venda;
        private $numero_da_venda_venda;
        private $nome_cliente_venda;
        private $produto_venda;
        private $quantidade_venda;
        private $valor_produto_unitario_venda;
        private $valor_produto_total_venda;
        private $total_venda_valor_bruto_venda;
        private $tipo_de_pagamento_venda;
        private $desconto_venda_venda;
        private $total_venda_atual_com_desconto_venda;
        private $codigo_pagamento_cartao_venda;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }
    }

?>