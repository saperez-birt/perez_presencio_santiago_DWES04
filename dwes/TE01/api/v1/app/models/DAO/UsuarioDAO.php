<?php
require "../app/models/DTO/UsuarioDTO.php";

class UsuarioDAO {
    private $db;

    public function __construct() {
        $this->db = DatabaseSingleton::getInstance();
    }

    public function getAllUsuarios() {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM usuarios";
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $usuariosDTO = array_map(function($fila) {
            return new UsuarioDTO(
                $fila['id_usuario'],
                $fila['nombre'],
                $fila['apellidos'],
                $fila['email']
            );
        }, $result);
    
        return $usuariosDTO;
    }

    public function getUsuarioById($id) {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM usuarios WHERE id_usuario = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $fila = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($fila) {
            return new UsuarioDTO(
                $fila['id_usuario'],
                $fila['nombre'],
                $fila['apellidos'],
                $fila['email']
            );
        }
        return null;
    }

    public function registerUsuario($nombre, $apellidos, $email) {
        $connection = $this->db->getConnection();
        $query = "INSERT INTO usuarios (nombre, apellidos, email) VALUES (:nombre, :apellidos, :email)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':apellidos', $apellidos);
        $statement->bindParam(':email', $email);
        
        if ($statement->execute()) {
            $id = $connection->lastInsertId();
            return new UsuarioDTO($id, $nombre, $apellidos, $email);
        }
        
        return null;
    }

    // Actualizar un usuario existente
    public function updateUsuario($id, $nombre, $apellidos, $email) {
        $connection = $this->db->getConnection();
        $query = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email WHERE id_usuario = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':apellidos', $apellidos);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($statement->execute()) {
            return $this->getUsuarioById($id);
        }
        
        return null;
    }

    // Eliminar un usuario
    public function deleteUsuario($id) {
        $connection = $this->db->getConnection();
        $query = "DELETE FROM usuarios WHERE id_usuario = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $statement->execute();
    }
};
?>