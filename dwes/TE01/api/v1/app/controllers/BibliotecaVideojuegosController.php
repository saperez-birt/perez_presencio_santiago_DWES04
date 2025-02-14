<?php
require  '../app/models/DAO/BibliotecaVideojuegosDAO.php';

class BibliotecaVideojuegosController {
    private $model;

    public function __construct() {
        $this->model = new BibliotecaVideojuegosDAO();
    }   

    public function getAllBibliotecaVideojuegos() {
        $users = $this->model->getBibliotecaVideojuegos();
        http_response_code(200);
        echo json_encode(['message' => 'BibliotecaVideojuegos retrieved successfully', 'data' => $users]);
    }

    public function getBibliotecaVideoujegoById($id_usuario) {
        $user = $this->model->getBibliotecaVideojuego($id_usuario);
        if ($user) {
            http_response_code(200);
            echo json_encode(['message' => 'BibliotecaVideojuego retrieved successfully', 'data' => $user]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'BibliotecaVideojuego not found']);
        }
    }

    public function registerBibliotecaVideojuego($updatedData) {
        if (empty($updatedData) || !is_array($updatedData)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid or missing data']);
            return;
        }
        
        $result = $this->model->registerBibliotecaVideojuego($updatedData['id_usuario'], $updatedData['id_videojuego'], $updatedData['fecha_compra']);
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => 'BibliotecaVideojuego registered successfully', 'data' => $updatedData]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to register user']);
        }
    }

    public function deleteBibliotecaVideojuegoById($id_usuario, $id_videojuego) {
        $result = $this->model->deleteBibliotecaVideojuegos($id_usuario, $id_videojuego);
        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => "BibliotecaVideojuego with ID {$id_usuario} deleted successfully"]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'BibliotecaVideojuego not found']);
        }
    }

    public function updateBibliotecaVideojuegosById($updatedData) {
        if (empty($updatedData) || !is_array($updatedData)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid or missing data']);
            return;
        }
        $result = $this->model->updateBibliotecaVideojuego($updatedData['id_usuario'], $updatedData['id_videojuego'], $updatedData['fecha_compra']);
        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => "BibliotecaVideojuego with ID  updated successfully", 'data' => $updatedData]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => "BibliotecaVideojuego with ID  not found"]);
        }
    }
}