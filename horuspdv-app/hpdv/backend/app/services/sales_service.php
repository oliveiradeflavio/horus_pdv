<?php
class SalesSerivce
{
    private $connect;
    private $sale;

    public function __construct(DbConnection $connect, SalesModel $sale)
    {
        $this->connect = $connect->getConnection();
        $this->sale = $sale;
    }

    public function getSaleNumber()
    {
        $query = "SELECT COUNT(*) AS numero_da_venda FROM tb_vendas";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function registerSale()
    {
        $query = "INSERT INTO tb_vendas (
                                    numero_da_venda,
                                    cliente,
                                    Vendedor,
                                    produto,
                                    quantidade,
                                    valor_unitario,
                                    subtotal,
                                    tipo_de_pagamento,
                                    desconto,
                                    valor_com_desconto,
                                    codigo_de_transacao_ou_chave_pix,
                                    valor_a_ser_pago )  
                                    VALUES (
                                    :numero_da_venda,
                                    :cliente,
                                    :vendedor,
                                    :produto,
                                    :quantidade,
                                    :valor_unitario,
                                    :subtotal,
                                    :tipo_de_pagamento,
                                    :desconto,
                                    :valor_com_desconto,
                                    :codigo_de_transacao_ou_chave_pix,
                                    :valor_a_ser_pago)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':numero_da_venda', $this->sale->__get('numero_da_venda'));
        $stmt->bindValue(':cliente', $this->sale->__get('cliente'));
        $stmt->bindValue(':vendedor', $this->sale->__get('vendedor'));
        $stmt->bindValue(':produto', $this->sale->__get('produto'));
        $stmt->bindValue(':quantidade', $this->sale->__get('quantidade'));
        $stmt->bindValue(':valor_unitario', $this->sale->__get('valor_unitario'));
        $stmt->bindValue(':subtotal', $this->sale->__get('subtotal'));
        $stmt->bindValue(':tipo_de_pagamento', $this->sale->__get('tipo_de_pagamento'));
        $stmt->bindValue(':desconto', $this->sale->__get('desconto'));
        $stmt->bindValue(':valor_com_desconto', $this->sale->__get('valor_com_desconto'));
        $stmt->bindValue(':codigo_de_transacao_ou_chave_pix', $this->sale->__get('codigo_de_transacao_ou_chave_pix'));
        $stmt->bindValue(':valor_a_ser_pago', $this->sale->__get('valor_a_ser_pago'));
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getProductData()
    {
        $query = "SELECT quantidade_produto, preco_unitario_produto, preco_total_em_produto FROM tb_produtos WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':id', $this->sale->__get('id'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateProductQuantity()
    {
        $query = "UPDATE tb_produtos SET quantidade_produto = :quantidade_produto, preco_total_em_produto = :preco_total_em_produto WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':quantidade_produto', $this->sale->__get('quantidade_produto'));
        $stmt->bindValue(':preco_total_em_produto', $this->sale->__get('preco_total_em_produto'));
        $stmt->bindValue(':id', $this->sale->__get('id'));
        $stmt->execute();
    }
}
