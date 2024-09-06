<?php
    require_once 'DAL/ProdutoDAO.php';

    class ProdutoModel {
        public ?int $id;
        public ?string $descricao;
        public ?string $preco;

        public function __construct(
            ?int $id = null,
            ?string $descricao = null,
            ?string $preco = null,

        ) {
            $this->id = $id;
            $this->descricao = $descricao;
            $this->preco = $preco;
        }

        public function getProdutos() {
            $produtoDAO = new ProdutoDAO();

            $produto = $produtoDAO->getProdutos();

            foreach ($produto as $chave => $produto) {
                $produto[$chave] = new ProdutoModel(
                    $produto['id'],
                    $produto['descricao'],
                    $produto['preco'],
                );
            }

            return $produto;
        }

        public function getProdutoPorId($id_produto) {
            $produtoDAO = new ProdutoDAO;

            $produto = $produtoDAO->getProdutoPorId($id_produto);

            $produto = new produtoModel(
                $produto['id'],
                $produto['descricao'],
                $produto['preco']
            );
            return $produto;
            
        }

        public function create() {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->createProduto($this);
        }

        public function update() {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->updateProduto($this);
        }

        public function delete() {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->deleteProduto($this);
        }

        public function validarProduto(string $descricao) {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->getNomeProduto($descricao);
        }
    }