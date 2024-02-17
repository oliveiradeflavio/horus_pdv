<?php

    class DadosEmpresariaisService{
        private $conexao;
        private $dados_empresariais;

        public function __construct(Conexao $conexao, DadosEmpresariaisModel $dados_empresariais){
            $this->conexao = $conexao->conectar();
            $this->dados_empresariais = $dados_empresariais;
        }

        public function consultarDadosEmpresariais(){
            $query = "SELECT * FROM tb_dados_empresariais";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function atualizarDadosEmpresariais(){
            $query = "UPDATE tb_dados_empresariais SET cnpj_dados_empresariais = :cnpj, nome_empresa_dados_empresariais = :nome, cep_dados_empresariais = :cep, estado_dados_empresariais = :estado, endereco_dados_empresariais = :endereco, numero_dados_empresariais = :numero, bairro_dados_empresariais = :bairro, cidade_dados_empresariais = :cidade, telefone_dados_empresariais = :telefone, celular_dados_empresariais = :celular, email_dados_empresariais = :email";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cnpj', $this->dados_empresariais->__get('cnpj'));
            $stmt->bindValue(':nome', $this->dados_empresariais->__get('nome'));
            $stmt->bindValue(':cep', $this->dados_empresariais->__get('cep'));
            $stmt->bindValue(':estado', $this->dados_empresariais->__get('estado'));
            $stmt->bindValue(':endereco', $this->dados_empresariais->__get('endereco'));
            $stmt->bindValue(':numero', $this->dados_empresariais->__get('numero'));
            $stmt->bindValue(':bairro', $this->dados_empresariais->__get('bairro'));
            $stmt->bindValue(':cidade', $this->dados_empresariais->__get('cidade'));
            $stmt->bindValue(':telefone', $this->dados_empresariais->__get('telefone'));
            $stmt->bindValue(':celular', $this->dados_empresariais->__get('celular'));
            $stmt->bindValue(':email', $this->dados_empresariais->__get('email'));
            $stmt->execute();
        }

        public function salvarDadosEmpresariais(){
            $query = "INSERT INTO tb_dados_empresariais (cnpj_dados_empresariais , nome_empresa_dados_empresariais, cep_dados_empresariais, estado_dados_empresariais, endereco_dados_empresariais, numero_dados_empresariais, bairro_dados_empresariais, cidade_dados_empresariais, telefone_dados_empresariais, celular_dados_empresariais, email_dados_empresariais) VALUES (:cnpj, :nome, :cep, :estado, :endereco, :numero, :bairro, :cidade, :telefone, :celular, :email)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cnpj', $this->dados_empresariais->__get('cnpj'));
            $stmt->bindValue(':nome', $this->dados_empresariais->__get('nome'));
            $stmt->bindValue(':cep', $this->dados_empresariais->__get('cep'));
            $stmt->bindValue(':estado', $this->dados_empresariais->__get('estado'));
            $stmt->bindValue(':endereco', $this->dados_empresariais->__get('endereco'));
            $stmt->bindValue(':numero', $this->dados_empresariais->__get('numero'));
            $stmt->bindValue(':bairro', $this->dados_empresariais->__get('bairro'));
            $stmt->bindValue(':cidade', $this->dados_empresariais->__get('cidade'));
            $stmt->bindValue(':telefone', $this->dados_empresariais->__get('telefone'));
            $stmt->bindValue(':celular', $this->dados_empresariais->__get('celular'));
            $stmt->bindValue(':email', $this->dados_empresariais->__get('email'));
            $stmt->execute();
        }
    }
       

?>