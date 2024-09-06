<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/usuarios' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],
                    '/status' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatus'
                    ],
                    '/produtos' => [
                        'controller' => 'ProdutoController',
                        'function' => 'getProdutos'
                    ],
                    '/itens-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'getItensPedido'
                    ],
                    '/pedidos' => [
                        'controller' => 'PedidoController',
                        'function' => 'getPedido'
                    ]
                ],
                'POST' => [
                    '/usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuario'
                    ],
                    '/criar-usuario' => [
                        'controller' => 'UsuarioController', 
                        'function' => 'createUsuario'
                    ],
                    '/buscar-usuario-id' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatusPorId'
                    ], 
                    '/buscar-produto-id' => [
                        'controller' => 'ProdutoController', 
                        'function' => 'getProdutoPorId'
                    ],
                    '/criar-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'createProduto'
                    ],
                    '/itens-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'getItensPedido'
                    ],
                    '/criar-item-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'createItensPedido'
                    ],
                    '/buscar-pedido-pessoa' => [ 
                        'controller' => 'PedidoController',
                        'function' => 'getPedidoPessoa'
                    ],
                    '/valor-total-pedido' => [ 
                        'controller' => 'PedidoController',
                        'function' => 'buscarValorTotalPedido'
                    ],
                    '/buscar-status' => [ 
                        'controller' => 'StatusController',
                        'function' => 'getStatus'
                    ],
                    '/cadastrar-pedido' => [ 
                        'controller' => 'PedidoController',
                        'function' => 'createPedido'
                    ],
                ],
                'PUT' => [
                    '/editar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'updateUsuario'
                    ],
                    '/editar-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'updateProduto'
                    ],
                    '/editar-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updatePedido'
                    ],
                    '/editar-status-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updateStatusPedido'
                    ],
                    '/editar-item-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'updateItemPedido'
                    ],
                ],
                'DELETE' => [
                    '/delete-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
                    ],
                    '/delete-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'deletePedido'
                    ],
                    '/excluir-item-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'deleteItensPedido'
                    ]

                ]
            ];
        }

        public function handleRequest(string $method, string $route): string {
            $routeExists = !empty($this->routes[$method][$route]);

            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!',
                    'result' => null
                ]);
            }

            $routeInfo = $this->routes[$method][$route];

            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }