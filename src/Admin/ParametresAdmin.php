<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class ParametresAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('nom')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('mission')
            ->add('aPropos')
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
            ->add('nomDuSite')
            ->add('mission', TextareaType::class, array('attr' => array('class' => 'ckeditor')))
            ->add('aPropos', TextareaType::class, array('attr' => array('class' => 'ckeditor')))
            ->add('nombreDeProjetRecent')
            ->add('nombreDeProjetParPage')
            ->add('address')
            ->add('ville')
            ->add('email1')
            ->add('email2')
            ->add('tel1')
            ->add('tel2')
            ->add('facebook')
            ->add('twitter')
            ->add('linkdin')
            ->add('instagram')
            ->add('imageFile', VichImageType::class, [
                'required' => false,])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nomDuSite')
            ->add('mission')
            ->add('aPropos')
            ->add('nombreDeProjetRecent')
            ->add('nombreDeProjetParPage')
            ->add('address')
            ->add('ville')
            ->add('email1')
            ->add('email2')
            ->add('tel1')
            ->add('tel2')
            ->add('facebook')
            ->add('twitter')
            ->add('linkdin')
            ->add('instagram')
            ->add('nom')
            ;
    }
}
