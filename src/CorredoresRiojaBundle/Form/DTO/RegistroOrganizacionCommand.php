<?php

namespace CorredoresRiojaBundle\Form\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of RegistroCorredorCommnad
 *
 * @author master
 */
class RegistroOrganizacionCommand {
        
    /**
     * @Assert\NotBlank()
     */
    private $nombre;
    
    /**
     * @Assert\NotBlank()
     */
    private $descripcion;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    
    /**
     * @Assert\NotBlank()
     */
    private $password;
    


    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
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


    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }


}
