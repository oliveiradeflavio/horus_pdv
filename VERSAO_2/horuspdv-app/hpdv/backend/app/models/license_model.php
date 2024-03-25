<?php
#[AllowDynamicProperties] #php 8.2
class LicenseModel
{
    private $id;
    private $id_usuario;
    private $data_ativacao_sistema;
    private $data_ultima_renovacao;
    private $data_proxima_renovacao;

    public function __get($attribute)
    {
        return $this->$attribute;
    }

    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }
}
