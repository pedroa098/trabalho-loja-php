<?php
    require_once 'Conexao.php';

    class ItensPedidoDAO {
        public function getItensPedido() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM item_pedido;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createItensPedido(ItensPedidoModel $itensPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO item_pedido VALUES (:id, :id_pedido, :id_produto, :quantidade, :id_status);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':id_pedido', $itensPedido->id_pedido);
            $stmt->bindValue(':id_produto', $itensPedido->id_produto);
            $stmt->bindValue(':quantidade', $itensPedido->quantidade);
            $stmt->bindValue(':id_status', $itensPedido->id_status);

            return $stmt->execute();
        }

        public function updateItensPedido(ItensPedidoModel $itensPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE item_pedido SET id = :id, id_pedido = :id_pedido, id_produto = id_produto, quantidade = :quantidade, id_status = :id_status WHERE id = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':id_pedido', $itensPedido->id_pedido);
            $stmt->bindValue(':id_produto', $itensPedido->id_produto);
            $stmt->bindValue(':quantidade', $itensPedido->quantidade);
            $stmt->bindValue(':id_status', $itensPedido->id_status);

            return $stmt->execute();
        }

        public function deleteItensPedido(ItensPedidoModel $itensPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM item_pedido WHERE id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $itensPedido->id);

            return $stmt->execute();
        }

        public function getValorTotalFromPedidoById($idPedido) {
            $conexao = (new conexao)->getConexao();

            $sql = "SELECT ip.*,ip.quantidade * p.precoProduto as valorTotal from item_pedido ip left join produto p on ip.idProduto = p.idProduto where ip.idPedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":id",$idPedido);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function verifyOrderItem(ItensPedidoModel $orderItemId){
            $connection = (new Conexao)->getConexao();

            $sql = "SELECT * FROM item_pedido WHERE id_pedido = :orderId AND id_produto = :productId";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':orderId', $orderItemId->id_pedido);
            $stmt->bindValue(':productId', $orderItemId->id_produto);
            $stmt->execute();

            return  $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function AddProductQuantity(ItensPedidoModel $orderItemId){
            $connection = (new Conexao)->getConexao();

            $sql = "UPDATE item_pedido
                    SET quantidade = quantidade + :quantidade
                    WHERE id_pedido = :id AND id_produto    = :id_produto;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $orderItemId->id_pedido);
            $stmt->bindValue(':id_produto', $orderItemId->id_produto);
            $stmt->bindValue(':quantidade', $orderItemId->quantidade);
            
            return $stmt->execute();
        }
    }
?>