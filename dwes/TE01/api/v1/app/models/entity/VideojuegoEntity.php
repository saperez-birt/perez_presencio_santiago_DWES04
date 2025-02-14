<?php

class VideojuegoEntity {
    private $id_videojuego;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $estudio;

    private $created_at;
    private $updated_at;

    public function __construct($id_videojuego, $nombre, $descripcion, $precio, $stock, $created_at, $updated_at) {
        $this->id_videojuego = $id_videojuego;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;

        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     */
    public function setStock($stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of estudio
     */
    public function getEstudio()
    {
        return $this->estudio;
    }

    /**
     * Set the value of estudio
     */
    public function setEstudio($estudio): self
    {
        $this->estudio = $estudio;

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