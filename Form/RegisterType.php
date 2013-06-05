<?php

namespace Galaxy\DocumentsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text')
                ->add('pointsTypeName', 'text')
                ->add('period', 'integer')
                ->add('periodCost', 'integer')
                ->add('acquisitionExtensionServices', 'textarea')
                ->add('start')
                ->add('accountHint', 'textarea')
                ->add('pointsTypeHint', 'textarea')
                ->add('textPaymentService', 'textarea')
                ->add('points', 'integer')
                ->add('cost', 'integer')
                ->add('notificationZeroBalance', 'textarea')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Galaxy\DocumentsBundle\Entity\Register',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return '';
    }

}
