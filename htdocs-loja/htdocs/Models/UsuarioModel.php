<?php
    require_once 'DAL/UsuarioDAO.php';

    class UsuarioModel {
        public ?int $id;
        public ?string $nome;
        public ?string $cpf;
        public ?string $senha;

        public function __construct(
            ?int $idUsuario = null,
            ?string $nome = null,
            ?string $cpf = null,
            ?string $senha = null
        ) {
            $this->id = $idUsuario;
            $this->nome = $nome;
            $this->cpf = $cpf;  
            $this->senha = $senha;
        }

        public function getUsuarios() {
            $usuarioDAO = new UsuarioDAO();

            $usuarios = $usuarioDAO->getUsuarios();

            foreach ($usuarios as $chave => $usuario) {
                $usuarios[$chave] = new UsuarioModel(
                    $usuario['id'],
                    $usuario['nome'],
                    $usuario['cpf'],
                    $usuario['senha']
                );
            }

            return $usuarios;
        }

        public function getUsuario($idUsuario) {
            $usuarioDAO = new UsuarioDAO;

            $usuario = $usuarioDAO->getUsuario($idUsuario);

            $usuario = new UsuarioModel(
                $usuario['id'],
                $usuario['nome'],
                $usuario['cpf'],
                $usuario['senha']
            );
            return $usuario;
            
        }

        public function create() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->createUsuario($this);
        }

        public function update() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->updateUsuario($this);
        }

        public function delete() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->deleteUsuario($this);
        }

        public function validarUsuario(string $cpf) {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->getCpfUsuario($cpf);
        }
    }
?>