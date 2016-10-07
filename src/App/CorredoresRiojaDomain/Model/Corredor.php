<?php

namespace App\CorredoresRiojaDomain\Model;

class Corredor {
    private $dni;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $salt;
    private $direccion;
    private $fechaNacimiento;
    
    function __construct($dni, $nombre, $apellidos, $email, $password, $direccion, $fechaNacimiento) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->salt = md5(time());
        $this->direccion = $direccion;
        $this->fechaNacimiento = $fechaNacimiento;
    }
    
    function getDni() {
        return $this->dni;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
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

    function getDireccion() {
        return $this->direccion;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

}
