<?php
    require_once 'DAL/ItensPedidoDAO.php';

    class ItensPedidoModel {
        public ?int $id;
        public ?string $id_pedido;
        public ?string $id_produto;
        public ?string $quantidade;
        public ?string $id_status;

        public function __construct(
            ?int $id = null,
            ?string $id_pedido = null,
            ?string $id_produto = null,
            ?string $quantidade = null,
            ?string $id_status = null,

        ) {
            $this->id = $id;
            $this->id_pedido = $id_pedido;
            $this->id_produto = $id_produto;
            $this->quantidade = $quantidade;
            $this->id_status = $id_status;
        }

        public function getItensPedido() {
            $itensPedidoDAO = new ItensPedidoDAO();

            $itensPedidos = $itensPedidoDAO->getItensPedido();

            foreach ($itensPedidos as $chave => $itensPedido) {
                $itensPedido[$chave] = new ItensPedidoModel(
                    $itensPedido['id_pedido'],
                    $itensPedido['id_produto'],
                    $itensPedido['quantidade'],
                    $itensPedido['id_status'],
                );
            }

            return $itensPedidos;
        }

        public function create() {
            $itensPedidoDAO = new ItensPedidoDAO();

            return $itensPedidoDAO->createItensPedido($this);
        }

        public function update() {
            $itensPedidoDAO = new ItensPedidoDAO();

            return $itensPedidoDAO->updateItensPedido($this);
        }

        public function delete() {
            $itensPedidoDAO = new ItensPedidoDAO();

            return $itensPedidoDAO->deleteItensPedido($this);
        }

        public function verifyOrderItem(){
            $orderItemDAO = new ItensPedidoDAO();

            return $orderItemDAO->verifyOrderItem($this);
        }

        public function AddProductQuantity(){
            $orderItemDAO = new ItensPedidoDAO();

            return $orderItemDAO->AddProductQuantity($this);
        }

        public function getValorTotalPedido($idPedido) {
            $ItemPedidoDAO = new ItensPedidoDAO;

            return $ItemPedidoDAO->getValorTotalFromPedidoById($idPedido);

            
            foreach ($itens as &$item) {
                $item = new itensPedidoModel(
                    $item['id_item_pedido'],
                    $item['idProduto'],
                    $item['idPedido'],
                    $item['quantidade'],
                    $item['valorTotal']
                );
            }
            return $itens;
        }
    }
?>
