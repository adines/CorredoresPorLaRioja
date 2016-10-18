<?php

namespace App\CorredoresRiojaDomain\Model;

class Organizacion {
    private $id;
    private $nombre;
    private $descripción;
    private $email;
    private $password;
    private $salt;
    private $slug;
    
    function __construct($id, $nombre, $descripción, $email, $password) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripción = $descripción;
        $this->email = $email;
        $this->password = $password;
        $this->salt = md5(time());
        $this->slug = Util::getSlug($nombre);
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripción() {
        return $this->descripción;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getSalt() {
        return $this->salt;
    }

    function getSlug() {
        return $this->slug;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripción($descripción) {
        $this->descripción = $descripción;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
