<?php

namespace AppBundle\Form;

use AppBundle\Entity\FolderRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('src')
            ->add('cloud', 'entity', [
                'required' => false,
                'class' => 'AppBundle:Cloud',
                'property' => 'name',
            ])
            ->add('folder', 'entity', [
                'required' => false,
                'class' => 'AppBundle:Folder',
                'property' => 'name',
            ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\File'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_file';
    }
}
