<?php

namespace Galaxy\DocumentsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('OA1', 'integer')
            ->add('text1', 'textarea', array('required' => false))
            ->add('summa1', 'number')
            ->add('account', 'integer')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Galaxy\DocumentsBundle\Entity\Document',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return '';
    }
}
