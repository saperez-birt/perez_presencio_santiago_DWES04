<?php
require  '../app/models/DAO/VideojuegoDAO.php';

class VideojuegoController {
    private $model;

    public function __construct() {
        $this->model = new VideojuegoDAO();
    }   

    public function getAllVideojuegos() {
        $games = $this->model->getAllVideojuegos();
        http_response_code(200);
        echo json_encode(['message' => 'Videojuegos retrieved successfully', 'data' => $games]);
    }

    public function getVideojuegoById($id) {
        $game = $this->model->getVideojuego($id);
        if ($game) {
            http_response_code(200);
            echo json_encode(['message' => 'Videojuego retrieved successfully', 'data' => $game]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Videojuego not found']);
        }
    }

    public function registerVideojuego($updatedData) {
        if (empty($updatedData) || !is_array($updatedData)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid or missing data']);
            return;
        }
    
        $result = $this->model->registerVideojuego($updatedData['nombre'], $updatedData['descripcion'], $updatedData['precio'], $updatedData['stock'], $updatedData['estudio']);
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => 'Videojuego registered successfully', 'data' => $updatedData]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to register user']);
        }
    }

    
    public function updateVideojuegoById($id, $updatedData) {
        if (empty($updatedData) || !is_array($updatedData)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid or missing data']);
            return;
        }
        $result = $this->model->updateVideojuego($id, $updatedData['nombre'], $updatedData['descripcion'], $updatedData['precio'], $updatedData['stock'], $updatedData['estudio']);
        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => "Videojuego with ID {$id} updated successfully", 'data' => $updatedData]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => "Videojuego with ID {$id} not found"]);
        }
    }

    public function deleteVideojuegoById($id) {
        $result = $this->model->deleteVideojuego($id);
        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => "Videojuego with ID {$id} deleted successfully"]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Videojuego not found']);
        }
    }
}