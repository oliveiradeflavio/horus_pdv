<?php
#[AllowDynamicProperties] #php 8.2
class SalesModel
{
    private $id;
    private $numero_da_venda;
    private $cliente;
    private $vendedor;
    private $produto;
    private $quantidade;
    private $valor_unitario;
    private $subtotal;
    private $tipo_de_pagamento;
    private $desconto;
    private $valor_com_desconto;
    private $codigo_de_transacao_ou_chave_pix;
    private $valor_a_ser_pago;
    private $data_criacao;
    private $data_modificacao;

    public function __get($attribute)
    {
        return $this->$attribute;
    }

    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }
}
