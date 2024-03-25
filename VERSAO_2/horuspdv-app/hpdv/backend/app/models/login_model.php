<?php
#[AllowDynamicProperties] #php 8.2
class LoginModel
{
    private $id;
    private $cpf;
    private $nome;
    private $email;
    private $usuario_acesso;
    private $senha_acesso;
    private $tipo_permissao;
    private $quantidade_sessao;
    private $data_ultimo_acesso;
    private $data_criacao;
    private $data_modificacao;
    private $token_reset_senha_acesso;
    private $horario_geracao_token;

    public function __get($attribute)
    {
        return $this->$attribute;
    }

    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }
}
