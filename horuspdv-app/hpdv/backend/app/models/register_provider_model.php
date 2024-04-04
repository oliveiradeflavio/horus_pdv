<?php
#[AllowDynamicProperties] #php 8.2
class RegisterProviderModel
{
    private $id;
    private $razao_social;
    private $nome_fantasia;
    private $cnpj;
    private $cep;
    private $cidade;
    private $uf;
    private $endereco;
    private $bairro;
    private $complemento;
    private $numero;
    private $ponto_referencia;
    private $telefone;
    private $celular;
    private $email;
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
