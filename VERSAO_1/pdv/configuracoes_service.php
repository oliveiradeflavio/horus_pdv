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

    public function alterarSenhaMaster(){
        $query = 'UPDATE tb_configuracoes SET senha_master_configuracoes = :senha_master_nova WHERE id_configuracoes = 1';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':senha_master_nova', $this->configuracoes->__get('senha_master_nova'));
        $stmt->execute();
    }
}



?>