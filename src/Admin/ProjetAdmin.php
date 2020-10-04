<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class ProjetAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('nom')
            ->add('description')
            ->add('datecreation')
            ->add('active')
            ->add('avant')
            ->add('auteur')
            ->add('contact')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('description')
            ->add('auteur')
            ->add('categorie')
            ->add('active')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('nom')
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor')))
            ->add('datecreation',DateType::class, array(
                // renders it as a single text box
                'widget' => 'single_text',
            ))
            ->add('active')
            ->add('avant')
            ->add('auteur')
            ->add('image1File', VichImageType::class, [
                'required' => false,])
            ->add('image2File', VichImageType::class, [
                    'required' => false,])
            ->add('image3File', VichImageType::class, [
                        'required' => false,])
            ->add('contact')
            ->add('categorie', ModelType::class, array(
                'class' => 'App\Entity\categorie',
                'property' => 'nom',
            ))
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nom')
            ->add('description')
            ->add('datecreation')
            ->add('active')
            ->add('avant')
            ->add('auteur')
            ->add('contact')
            ;
    }
}
