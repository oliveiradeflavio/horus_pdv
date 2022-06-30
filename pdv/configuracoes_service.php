<?php

class ConfiguracoesService{
    private $conexao;
    private $configuracoes;

    public function __construct(Conexao $conexao, Configuracoes $configuracoes){
        $this->conexao = $conexao->conectar();
        $this->configuracoes = $configuracoes;
    }

    public function consultaConfiguracoes(){
        $query = 'SELECT * FROM tb_configuracoes';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}



?>