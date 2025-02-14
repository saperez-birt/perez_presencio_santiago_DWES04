<?php

class BibliotecaVideojuegosDTO implements JsonSerializable {
    private $id_usuario;
    private $id_videojuego;
    private $fecha_compra;

    public function __construct($id_usuario, $id_videojuego, $fecha_compra) {
        $this->id_usuario = $id_usuario;
        $this->id_videojuego = $id_videojuego;
        $this->fecha_compra = $fecha_compra;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    /**
     * Get the value of id_usuario
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Get the value of id_videojuego
     */
    public function getIdVideojuego()
    {
        return $this->id_videojuego;
    }

    /**
     * Get the value of fecha_compra
     */
    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }
};
?>