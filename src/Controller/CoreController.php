<?php

namespace App\Controller;

use App\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends Controller
{
    /**
     * Page d'accueil
     * 
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('core/index.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * Affiche la liste des services
     * 
     * @Route("/services", name="services")
     */
    public function services( )
    {
        return $this->render('core/services.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * Affiche un service
     * 
     * @Route("/service/{service_slug}", name="service")
     */
    public function service($service_slug)
    {
        return $this->render('core/index.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * Affiche une liste de produit paginée
     * 
     * @Route("/projets/{page}", requirements ={"page"="\d+"}, name="projets")
     */
    public function projets($page=1)
    {
        $nbreDePlanParPage = 12;
        $em = $this->getDoctrine()->getManager();
        $projets = $em->getRepository(Projet::class)->rechercheTout($nbreDePlanParPage, $page);
        $nbreDePage = ceil(count($projets) / $nbreDePlanParPage);
        return $this->render('core/projets.html.twig', [
            'projets' => $projets,'nbreDePage' => $nbreDePage,'page' => $page,
        ]);
    }

    /**
     * Affiche un produit
     * 
     * @Route("/projet/{projet_slug} ", name="projet")
     */
    public function produit($projet_slug)
    {

        $em = $this->getDoctrine()->getManager();
        $projet = $em->getRepository(Projet::class)->findOneBySlug($projet_slug);
        return $this->render('core/projet.html.twig', [
            'projet' => $projet,
        ]);
    }

    /**
     * Affiche la page qui décrit Emergence et Actualisation
     * 
     * @Route("/apropos", name="apropos")
     */
    public function apropos()
    {
        return $this->render('core/apropos.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * Affiche la page d'actualités
     * 
     * @Route("/actualites", name="actualites")
     */
    public function actualites()
    {
        return $this->render('core/actualites.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('core/contact.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }
}
