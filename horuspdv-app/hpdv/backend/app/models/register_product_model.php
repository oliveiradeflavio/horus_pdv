<?php
#[AllowDynamicProperties] #php 8.2
class RegisterProductModel
{
    private $id;
    private $imagem_produto;
    private $nome_produto;
    private $codigo_produto;
    private $fornecedor;
    private $descricao_produto;
    private $quantidade_produto;
    private $preco_unitario_produto;
    private $preco_venda_produto;
    private $preco_total_em_produto;
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
