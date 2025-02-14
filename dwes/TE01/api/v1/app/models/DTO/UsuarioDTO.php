<?php

class UsuarioDTO implements JsonSerializable {
    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $email;

    public function __construct($id_usuario, $nombre, $apellidos, $email) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }
};

?>