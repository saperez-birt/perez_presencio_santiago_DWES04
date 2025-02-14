<?php

require "../core/DatabaseSingleton.php";
require "../app/models/DTO/BibliotecaVideojuegosDTO.php";

class BibliotecaVideojuegosDAO {
    private $db;

    public function __construct() {
        $this->db = DatabaseSingleton::getInstance();
    }

    public function getBibliotecaVideojuegos() {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM biblioteca_videojuegos";
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $bibliotecaVideojuegosDTO = array_map(function($fila) {
            return new BibliotecaVideojuegosDTO(
                $fila['id_usuario'],
                $fila['id_videojuego'],
                $fila['fecha_compra']
            );
        }, $result);

        return $bibliotecaVideojuegosDTO;
    }

    public function getBibliotecaVideojuego($id_usuario) {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM biblioteca_videojuegos WHERE id_usuario = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $fila = $statement->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new BibliotecaVideojuegosDTO(
                $fila['id_usuario'],
                $fila['id_videojuego'],
                $fila['fecha_compra']
            );
        }
    }

    public function registerBibliotecaVideojuego($id_usuario, $id_videojuego, $fecha_compra) {
        $connection = $this->db->getConnection();
        $query = "INSERT INTO biblioteca_videojuegos (id_usuario, id_videojuego, fecha_compra) VALUES (:id_usuario, :id_videojuego, :fecha_compra)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id_usuario', $id_usuario);
        $statement->bindParam(':id_videojuego', $id_videojuego);
        $statement->bindParam(':fecha_compra', $fecha_compra);

        if ($statement->execute()) {
            $id = $connection->lastInsertId();
            return new BibliotecaVideojuegosDTO($id, $id_usuario, $id_videojuego, $fecha_compra);
        }
        return null;
    }

    public function updateBibliotecaVideojuegos($id_usuario, $id_videojuego, $fecha_compra) {
        $connection = $this->db->getConnection();
        $query = "UPDATE biblioteca_videojuegos SET fecha_compra = :fecha_compra WHERE id_usuario = :id_usuario AND id_videojuego = :id_videojuego";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id_usuario', $id_usuario);
        $statement->bindParam(':id_videojuego', $id_videojuego);
        $statement->bindParam(':fecha_compra', $fecha_compra);

        return $statement->execute();
    }

    public function deleteBibliotecaVideojuegos($id_usuario, $id_videojuego) {
        $connection = $this->db->getConnection();
        $query = "DELETE FROM biblioteca_videojuegos WHERE id_usuario = :id_usuario AND id_videojuego = :id_videojuego";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id_usuario', $id_usuario);
        $statement->bindParam(':id_videojuego', $id_videojuego);
        
        return $statement->execute();
    }
}

?>