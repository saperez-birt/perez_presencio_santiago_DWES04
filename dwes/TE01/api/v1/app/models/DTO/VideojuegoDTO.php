<?php

class VideoJuegoDTO implements JsonSerializable {
    private $id_videojuego;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $estudio;

    public function __construct($id_videojuego, $nombre, $descripcion, $precio, $stock, $estudio) {
        $this->id_videojuego = $id_videojuego;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->estudio = $estudio;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    /**
     * Get the value of id_videojuego
     */
    public function getIdVideojuego()
    {
        return $this->id_videojuego;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Get the value of estudio
     */
    public function getEstudio()
    {
        return $this->estudio;
    }
};