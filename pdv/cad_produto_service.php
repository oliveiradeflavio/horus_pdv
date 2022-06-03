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