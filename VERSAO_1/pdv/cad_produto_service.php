<?php

    class CadProdutoService{
        private $conexao;
        private $produto;

        public function __construct(Conexao $conexao, CadProduto $produto){
            $this->conexao = $conexao->conectar();
            $this->produto = $produto;
        }

        public function mostrarTodosProdutos(){
            $query = 'SELECT * FROM tb_produtos';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function alterarProduto(){
            $query = "UPDATE tb_produtos SET nome_produto = :nome, codigo_produto = :codigo, descricao_produto = :descricao, quantidade_produto = :quantidade, preco_unitario_produto = :preco_unitario, preco_venda_produto = :preco_venda, preco_total_produto = :preco_total, foto_produto = :foto WHERE id_produto = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->produto->__get('nome'));
            $stmt->bindValue(':codigo', $this->produto->__get('codigo'));
            $stmt->bindValue(':descricao', $this->produto->__get('descricao'));
            $stmt->bindValue(':quantidade', $this->produto->__get('quantidade'));
            $stmt->bindValue(':preco_unitario', $this->produto->__get('preco_unitario'));
            $stmt->bindValue(':preco_venda', $this->produto->__get('preco_venda'));
            $stmt->bindValue(':preco_total', $this->produto->__get('preco_total'));
            $stmt->bindValue(':foto', $this->produto->__get('foto'));
            $stmt->bindValue(':id', $this->produto->__get('id'));
            $stmt->execute();
        }

        public function excluirProduto(){
            $query = 'DELETE FROM tb_produtos WHERE id_produto = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->produto->__get('id'));
            $stmt->execute();
        }

        public function cadastrarProduto(){
            $query = "INSERT INTO tb_produtos (foto_produto, nome_produto, codigo_produto, descricao_produto, quantidade_produto, preco_unitario_produto, preco_venda_produto, preco_total_produto) VALUES (:foto_produto, :nome_produto, :codigo_produto, :descricao_produto, :quantidade_produto, :preco_unitario_produto, :preco_venda_produto, :preco_total_produto)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':foto_produto', $this->produto->__get('foto'));
            $stmt->bindValue(':nome_produto', $this->produto->__get('nome'));
            $stmt->bindValue(':codigo_produto', $this->produto->__get('codigo'));
            $stmt->bindValue(':descricao_produto', $this->produto->__get('descricao'));
            $stmt->bindValue(':quantidade_produto', $this->produto->__get('quantidade'));
            $stmt->bindValue(':preco_unitario_produto', $this->produto->__get('preco_unitario'));
            $stmt->bindValue(':preco_venda_produto', $this->produto->__get('preco_venda'));
            $stmt->bindValue(':preco_total_produto', $this->produto->__get('preco_total'));
            $stmt->execute();
        }

        
    }

?>