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
            ->add('categorie', null, [
                'editable' => true
            ]);

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

        /* // get the current Image instance
        $image = $this->getSubject()->getImage1();
        

        // use $fileFormOptions so we can add other options to the field
        $fileFormOptions = ['required' => false];
        if ($image) {
            // get the container so the full path to the image can be set

            $container = $this->getConfigurationPool()->getContainer();
            $path = $container->get('vich_uploader.templating.helper.uploader_helper')->asset($this->getSubject(), 'image1File');
            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath().'/'.$path;
            // add a 'help' option containing the preview's img tag
            $fileFormOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview"/>';
            $fileFormOptions['help_html'] = true;
        } */

        $formMapper
        
            ->add('nom')
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor')))
            ->add('datecreation',DateType::class, array(
                // renders it as a single text box
                'widget' => 'single_text',
            ));

            if ($this->checkUserHasRole('ROLE_ACTIVATION')) {
                $formMapper->add('active')
                           ->add('avant');
            }
            
            $formMapper
            ->add('auteur')
            ->add('image1File', VichImageType::class, [
                'required' => false,
                'attr' => array('style' => 'max-height: 200px;
                max-width: 200px;')])
            ->add('image2File', VichImageType::class, [
                    'required' => false,
                    'attr' => array('style' => 'max-height: 200px;
                        max-width: 200px;')])
            ->add('image3File', VichImageType::class, [
                        'required' => false,
                        'attr' => array('style' => 'max-height: 200px;
                        max-width: 200px;'),])
            ->add('contact')
            ->add('categorie', ModelType::class, array(
                'class' => 'App\Entity\Categorie',
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
