<?php

namespace CorredoresRiojaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use CorredoresRiojaBundle\Form\Transformer\RegistroOrganizacionTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Description of CorredorType
 *
 * @author master
 */
class OrganizacionType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('email')
                ->add('nombre')
                ->add('descripcion')
                // Pedimos confirmación de la contraseña    
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Las contraseñas deben coincidir.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Contraseña'),
                    'second_options' => array('label' => 'Repite contraseña'),
                ));
                
                


        $builder->addViewTransformer(new RegistroOrganizacionTransformer());
    }

    public function getName() {
        return 'organizacion';
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CorredoresRiojaBundle\Form\DTO\RegistroOrganizacionCommand',
            'error_mapping' => array('passwordLegal' => 'password')
        ));
    }
}
