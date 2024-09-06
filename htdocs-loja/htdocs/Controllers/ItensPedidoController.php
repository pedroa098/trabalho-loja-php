<?php
    require_once './models/ItensPedidoModel.php';

    class ItensPedidoController {
        public function getItensPedido() {
            $itensPedidoModel = new ItensPedidoModel();

            $itensPedido = $itensPedidoModel->getItensPedido();

            return json_encode([
                'error' => null,
                'result' => $itensPedido
            ]);
        }

        public function createItensPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id_pedido']))
                return $this->mostrarErro('Você deve informar o id_pedido!');

            if (empty($dados['id_produto']))
                return $this->mostrarErro('Você deve informar o id_produto!');

            if (empty($dados['quantidade']))
                return $this->mostrarErro('Você deve informar a quantidade!');

            if (empty($dados['id_status']))
                return $this->mostrarErro('Você deve informar o id_status!');
        
            $orderItemData = new ItensPedidoModel(
                null,
                $dados['id_pedido'],
                $dados['id_produto'],
                $dados['quantidade'],
                $dados['id_status']);

                $orderItemModel = new ItensPedidoModel();

                if(($orderItemData->verifyOrderItem())){
                    $orderItem = $orderItemData->AddProductQuantity();
                }
                else{
                    $orderItem = $orderItemData->create();
                }

            return json_encode([
                'error' => null,
                'result' => $orderItem
            ]);
        }

        public function updateItensPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id_pedido']))
                return $this->mostrarErro('Você deve informar o id_pedido!');

            if (empty($dados['id_produto']))
                return $this->mostrarErro('Você deve informar o id_produto!');

            if (empty($dados['quantidade']))
                return $this->mostrarErro('Você deve informar a quantidade!');

            if (empty($dados['id_status']))
                return $this->mostrarErro('Você deve informar o id_status!');
        
            $itensPedido = new itensPedidoModel(
                null,
                $dados['id_pedido'],
                $dados['id_produto'],
                $dados['quantidade'],
                $dados['id_status']);

            $itensPedido->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteItensPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id');

            $itensPedido = new ItensPedidoModel($dados['id']);

            $itensPedido->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getValorTotalFromPedidoById() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['id_pedido'])) {
                return $this->mostrarErro('Você deve informar o idPedido');
            }
            $itemPedidoModel = new itensPedidoModel();

            $result = $itemPedidoModel->getValorTotalPedido($dados['id_pedido']);

            return json_encode([
                'error' => null,
                'result' => $result
            ]);

        }
        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }
?>