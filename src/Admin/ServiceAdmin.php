<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class ServiceAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('nom')
            ->add('description')
            ->add('active')
            ->add('avant')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('description')
            ->add('active', null, [
                'editable' => true
            ])
            ->add('avant', null, [
                'editable' => true
            ])
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
            ->add('description')
            ->add('active')
            ->add('avant')
            ->add('descriptionAvant')
            ->add('imageFile', VichImageType::class, [
                'required' => false,])
            ->add('imageAvantFile', VichImageType::class, [
                    'required' => false,])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nom')
            ->add('description')
            ->add('descriptionAvant')
            ->add('active')
            ->add('avant')
            ;
    }
}
