<?php

class BibliotecaVideojuegosEntity {
    private $id_usuario;
    private $id_videojuego;
    private $fecha_compra;

    private $created_at;
    private $updated_at;

    public function __construct($id_usuario, $id_videojuego, $fecha_compra, $created_at, $updated_at) {
        $this->id_usuario = $id_usuario;
        $this->id_videojuego = $id_videojuego;
        $this->fecha_compra = $fecha_compra;

        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }


    /**
     * Get the value of id_usuario
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     */
    public function setIdUsuario($id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of id_videojuego
     */
    public function getIdVideojuego()
    {
        return $this->id_videojuego;
    }

    /**
     * Set the value of id_videojuego
     */
    public function setIdVideojuego($id_videojuego): self
    {
        $this->id_videojuego = $id_videojuego;

        return $this;
    }

    /**
     * Get the value of fecha_compra
     */
    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }

    /**
     * Set the value of fecha_compra
     */
    public function setFechaCompra($fecha_compra): self
    {
        $this->fecha_compra = $fecha_compra;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
};

?>