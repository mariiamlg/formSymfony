<?php

namespace MCM\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id','hidden')
            ->add('fullName', null, array(
                'label' => 'Full name*'
            ))
            ->add('email', null, array(
                'label' => 'Email*',
                'attr' => ['pattern' => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$']
            ))
            ->add('idCard', null, array(
                'label' => 'Id Card*',
                'attr' => ['pattern' => '^([0-9XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE])|([0-9]{8,8}[A-Za-z])$/i']
            ))
            ->add('subscribed', null, array(
                'required' => false,
             ))
            ->add('typeCachtment','choice', 
                    array(
                        'choices'=> array('telephone'=> 'Telephone','web'=>'Web','face'=>'Face to face'),
                        'placeholder'=>'Select a type',
                        'required' => false)
                    )
            ->add('address', null, array(
                'required' => false
             ))
            ->add('zipCode', null, array(
                'required' => false
             ))
            ->add('state', null, array(
                'required' => false
             ))
            ->add('city', null, array(
                'required' => false
             ))
            ->add('country', null, array(
                'required' => false
             ))
            ->add('comments', 'textarea', array(
                'required' => false
             ))
            ->add('save','submit', array('label'=> $options['save_button_label']))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MCM\ClientBundle\Entity\Client',
                    'save_button_label' => 'Save client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mcm_clientbundle_client';
    }
}
