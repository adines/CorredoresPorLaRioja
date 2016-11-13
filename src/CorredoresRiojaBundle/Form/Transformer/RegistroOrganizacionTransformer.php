<?php


namespace CorredoresRiojaBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use CorredoresRiojaBundle\Form\DTO\RegistroOrganizacionCommand;
use App\CorredoresRiojaDomain\Model\Organizacion;

/**
 * Description of RegistroCorredorTransformer
 *
 * @author master
 */
class RegistroOrganizacionTransformer implements DataTransformerInterface{
    public function reverseTransform($value) {

        $organizacion = new Organizacion(null, $value->getNombre(),    
                                $value->getDescripcion(), $value -> getEmail(),
                                  $value->getPassword());
        return $organizacion;
    }

    public function transform($value) {
        if ($value === null) {
            return null;
        }
        $registroOrganizacionCommand = new RegistroOrganizacionCommand();
        $registroOrganizacionCommand->setNombre($value->getNombre());
        $registroOrganizacionCommand->setDescripcion($value->getDescripcion());
        $registroOrganizacionCommand->setEmail($value->getEmail());
        $registroOrganizacionCommand->setPassword($value->getPassword());
        return $registroOrganizacionCommand;
    }

}
