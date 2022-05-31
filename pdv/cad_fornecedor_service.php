<?php

    class CadFornecedorService{

        private $conexao;
        private $fornecedor;

        public function __construct(Conexao $conexao, CadFornecedor $fornecedor){
            $this->conexao = $conexao->conectar();
            $this->fornecedor = $fornecedor;
        }

        public function consultaCadFornecedor(){
            $query = 'SELECT * FROM tb_fornecedores WHERE cnpj_fornecedor = :cnpj';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cnpj', $this->fornecedor->__get('cnpj'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function inserirCadFornecedor(){
            $query = 'INSERT INTO tb_fornecedores (cnpj_fornecedor, razao_social_fornecedor, nome_fantasia_fornecedor, cep_fornecedor, estado_fornecedor, cidade_fornecedor, endereco_fornecedor, numero_fornecedor, complemento_fornecedor, bairro_fornecedor, telefone_fornecedor, celular_fornecedor, email_fornecedor) VALUES (:cnpj, :razao_social, :nome_fantasia, :cep, :estado, :cidade, :endereco, :numero, :complemento, :bairro, :telefone, :celular, :email)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cnpj', $this->fornecedor->__get('cnpj'));
            $stmt->bindValue(':razao_social', $this->fornecedor->__get('razao_social'));
            $stmt->bindValue(':nome_fantasia', $this->fornecedor->__get('nome_fantasia'));
            $stmt->bindValue(':cep', $this->fornecedor->__get('cep'));
            $stmt->bindValue(':estado', $this->fornecedor->__get('estado'));
            $stmt->bindValue(':cidade', $this->fornecedor->__get('cidade'));
            $stmt->bindValue(':endereco', $this->fornecedor->__get('endereco'));
            $stmt->bindValue(':numero', $this->fornecedor->__get('numero'));
            $stmt->bindValue(':complemento', $this->fornecedor->__get('complemento'));
            $stmt->bindValue(':bairro', $this->fornecedor->__get('bairro'));
            $stmt->bindValue(':telefone', $this->fornecedor->__get('telefone'));
            $stmt->bindValue(':celular', $this->fornecedor->__get('celular'));
            $stmt->bindValue(':email', $this->fornecedor->__get('email'));
            $stmt->execute();

        }
        
    }



?>