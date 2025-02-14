<?php

require "../app/models/DTO/VideojuegoDTO.php";

class VideojuegoDAO {
    private $db;

    public function __construct() {
        $this->db = DatabaseSingleton::getInstance();
    }

    public function getAllVideojuegos() {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM videojuegos";
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $videojuegosDTO = array_map(function($fila) {
            return new VideoJuegoDTO(
                $fila['id_videojuego'],
                $fila['nombre'],
                $fila['descripcion'],
                $fila['precio'],
                $fila['stock'],
                $fila['estudio']
            );
        }, $result);
    
        return $videojuegosDTO;
    }

    public function getVideojuego($id) {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM videojuegos WHERE id_videojuego = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $fila = $statement->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new VideoJuegoDTO(
                $fila['id_videojuego'],
                $fila['nombre'],
                $fila['descripcion'],
                $fila['precio'],
                $fila['stock'],
                $fila['estudio']
            );
        }
        return null;
    }

    public function registerVideojuego($nombre, $descripcion, $precio, $stock, $estudio) {
        $connection = $this->db->getConnection();
        $query = "INSERT INTO videojuegos (nombre, descripcion, precio, stock, estudio) VALUES (:nombre, :descripcion, :precio, :stock, :estudio)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->bindParam(':precio', $precio);
        $statement->bindParam(':stock', $stock);
        $statement->bindParam(':estudio', $estudio);

        if ($statement->execute()) {
            $id = $connection->lastInsertId();
            return new VideoJuegoDTO($id, $nombre, $descripcion, $precio, $stock, $estudio);
        }
        return null;
    }

    public function updateVideojuego($id, $nombre, $descripcion, $precio, $stock, $estudio) {
        $connection = $this->db->getConnection();
        $query = "UPDATE videojuegos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock, estudio = :estudio WHERE id_videojuego = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->bindParam(':precio', $precio);
        $statement->bindParam(':stock', $stock);
        $statement->bindParam(':estudio', $estudio);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->getVideojuego($id);
        }

        return null;
    }

    public function deleteVideojuego($id) {
        $connection = $this->db->getConnection();
        $query = "DELETE FROM videojuegos WHERE id_videojuego = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        }

        return false;
    }
}

?>
