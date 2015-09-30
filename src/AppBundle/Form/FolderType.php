<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FolderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $folderId = $builder->getData()->getId();
        $builder
            ->add('name')
            ->add('parent', 'entity', [
                'required' => false,
                'class' => 'AppBundle:Folder',
                'property' => 'name',
                'query_builder' => function (EntityRepository $er) use ($folderId) {
                    $queryBuilder = $er->createQueryBuilder('f')->select('f');
                    if ($folderId) {
                        $queryBuilder->where('f.id !=:currentFolderId')
                            ->setParameter('currentFolderId', $folderId);
                    }
                    return $queryBuilder;

                }
            ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Folder'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_folder';
    }
}
