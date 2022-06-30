<?php

    class CadCliente{
        private $id_cliente;
        private $cpf_cliente;
        private $dt_nascimento_cliente;
        private $nome_cliente;
        private $cep_cliente;
        private $estado_cliente;
        private $cidade_cliente;
        private $endereco_cliente;
        private $numero_cliente;
        private $complemento_cliente;
        private $bairro_cliente;
        private $celular_cliente;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }

}

?>