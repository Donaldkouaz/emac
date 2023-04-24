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

final class ServiceAdmin extends AbstractAdmin
{

        /**
 * @param string $role
 * @return bool
 */
protected function checkUserHasRole(string $role): bool
{

    $securityContext = $this->getConfigurationPool()->getContainer()->get('security.authorization_checker');
    try {
        return $securityContext->isGranted($role);
    } catch (AuthenticationCredentialsNotFoundException $e) {
        return false;
    }
}

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
            ->add('description');
            if ($this->checkUserHasRole('ROLE_ACTIVATION')) {
                $listMapper->add('active', null, [
                    'editable' => true
                ])
                ->add('avant', null, [
                    'editable' => true
                ]);
            }
            else
            {
                $listMapper->add('active')
                           ->add('avant');
            }
            $listMapper
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
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor')));

            if ($this->checkUserHasRole('ROLE_ACTIVATION')) {
                $formMapper->add('active')
                           ->add('avant');
            }
            
            $formMapper
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
