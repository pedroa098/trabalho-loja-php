<?php
    require_once './models/ProdutoModel.php';

    class ProdutoController {
        public function getProdutos() {
            $produtoModel = new ProdutoModel();

            $produto = $produtoModel->getProdutos();

            return json_encode([
                'error' => null,
                'result' => $produto
            ]);
        }

        public function getProdutoPorId() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id!');

            $response = (new ProdutoModel())->getProdutoPorId($dados['id']);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);


            if (empty($dados['descricao']))
                return $this->mostrarErro('Você deve informar a quantidade!');

            if (empty($dados['preco']))
                return $this->mostrarErro('Você deve informar o preco!');
        
            $produto = new ProdutoModel(
                null,
                $dados['descricao'],
                $dados['preco']);

            $validacao = $produto->validarProduto($dados['descricao']);

            if ($validacao['descricao'] >= 1) {
                return $this->mostrarErro("já existe um produto com esta descricao");
            }
    
                $produto->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o ID!');

            if (empty($dados['quantidade']))
                return $this->mostrarErro('Você deve informar a quantidade!');

            if (empty($dados['preco']))
                return $this->mostrarErro('Você deve informar o preco!');
        
            $produto = new ProdutoModel(
                $dados['id'],
                $dados['descricao'],
                $dados['preco'],
            );

            $validacao = $produto->validarProduto($dados['descricao']);

            if ($validacao['descricao'] >= 1) {
                return $this->mostrarErro("já existe um produto com esta descricao");
            }

            $produto->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id');

            $produto = new ProdutoModel($dados['id']);

            $produto->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }