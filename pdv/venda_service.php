<?php

    class VendaService{
        private $conexao;
        private $venda;

        public function __construct(Conexao $conexao, Venda $venda){
            $this->conexao = $conexao->conectar();
            $this->venda = $venda;
        }

        public function contador(){
            $query = "SELECT COUNT(*) AS numero_da_venda_venda FROM tb_vendas";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            $contador = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $contador;
        }

        public function consultarProduto(){
            $query = "SELECT * FROM tb_produtos WHERE id_produto = :id_produto";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_produto', $this->venda->__get('id_produto'));
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function atualizarQuantidadeProduto(){
            $query = "UPDATE tb_produtos SET quantidade_produto = :quantidade_produto, preco_total_produto = :preco_total_produto WHERE id_produto = :id_produto";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':quantidade_produto', $this->venda->__get('quantidade_produto'));
            $stmt->bindValue(':preco_total_produto', $this->venda->__get('preco_total_produto'));
            $stmt->bindValue(':id_produto', $this->venda->__get('id_produto'));
            $stmt->execute();
        }

        public function inserirVenda(){
            $query = 'INSERT INTO tb_vendas (numero_da_venda_venda, nome_cliente_venda, produto_venda, quantidade_venda, valor_produto_unitario_venda, valor_produto_total_venda, total_venda_valor_bruto_venda, tipo_de_pagamento_venda, desconto_venda_venda, total_venda_atual_com_desconto_venda, codigo_pagamento_cartao_venda) VALUES (:numero_da_venda_venda, :nome_cliente_venda, :produto_venda, :quantidade_venda, :valor_produto_unitario_venda, :valor_produto_total_venda, :total_venda_valor_bruto_venda, :tipo_de_pagamento_venda, :desconto_venda_venda, :total_venda_atual_com_desconto_venda, :codigo_pagamento_cartao_venda)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':numero_da_venda_venda', $this->venda->__get('numero_da_venda_venda'));
            $stmt->bindValue(':nome_cliente_venda', $this->venda->__get('nome_cliente_venda'));
            $stmt->bindValue(':produto_venda', $this->venda->__get('produto_venda'));
            $stmt->bindValue(':quantidade_venda', $this->venda->__get('quantidade_venda'));
            $stmt->bindValue(':valor_produto_unitario_venda', $this->venda->__get('valor_produto_unitario_venda'));
            $stmt->bindValue(':valor_produto_total_venda', $this->venda->__get('valor_produto_total_venda'));
            $stmt->bindValue(':total_venda_valor_bruto_venda', $this->venda->__get('total_venda_valor_bruto_venda'));
            $stmt->bindValue(':tipo_de_pagamento_venda', $this->venda->__get('tipo_de_pagamento_venda'));
            $stmt->bindValue(':desconto_venda_venda', $this->venda->__get('desconto_venda_venda'));
            $stmt->bindValue(':total_venda_atual_com_desconto_venda', $this->venda->__get('total_venda_atual_com_desconto_venda'));
            $stmt->bindValue(':codigo_pagamento_cartao_venda', $this->venda->__get('codigo_pagamento_cartao_venda'));
            $stmt->execute();
        }       
    }

?>