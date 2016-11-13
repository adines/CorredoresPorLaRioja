<?php

namespace CorredoresRiojaBundle\Security;

/**
 * Description of CorredorUserProvider
 *
 * @author adines
 */
use CorredoresRiojaBundle\Security\OrganizacionUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\CorredoresRiojaDomain\Repository\IOrganizacionRepository;

class OrganizacionUserProvider implements UserProviderInterface {
    
	private $organizacionesrepository;
    
	public function __construct(IOrganizacionRepository $repository) {
    	// Inyectamos el repositorio
    	$this -> organizacionesrepository = $repository;
	}
    
    
	public function loadUserByUsername($username) {
    	// buscamos el usuario
    	$userData = $this-> organizacionesrepository -> buscarOrganizacionEmail($username);
    	// si existe el corredor, devolvemos un CorredorUser de 
       // lo contrario devolvemos una excepción
    	if ($userData) {
        	$password = $userData->getPassword();
        	$salt = $userData -> getSalt();
        	return new OrganizacionUser($username, $password, $salt);
    	}

    	throw new UsernameNotFoundException(
        	sprintf('No existe un usuario con email "%s".', $username)
    	);
   	 	 
	}
       // La definición de estas dos funciones es casi siempre la misma
	public function refreshUser(UserInterface $user) {
    	if (!$user instanceof OrganizacionUser) {
        	throw new UnsupportedUserException(
            	sprintf('Instances of "%s" are not supported.', get_class($user))
        	);
    	}

    	return $this->loadUserByUsername($user->getUsername());
	}

	public function supportsClass($class) {
    	   return $class === 'CorredoresRiojaBundle\Security\OrganizacionUser';
	}
    
}
