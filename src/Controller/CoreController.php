<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Temoignages;
use App\Entity\Faq;
use App\Entity\Parametres;
use App\Entity\Partenaire;
use App\Entity\Service;
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
        $em = $this->getDoctrine()->getManager();
        $parametres = $em->getRepository(Parametres::class)->findOneByNom("options");
        $projets = $em->getRepository(Projet::class)->findBy(
            ['avant' => 'true'],
            ['datecreation' => 'DESC']);
        $services = $em->getRepository(Service::class)->findByAvant(true);
        $partenaires = $em->getRepository(Partenaire::class)->findAll();
        
        return $this->render('core/index.html.twig', [
            'projets' => $projets,
            'services' => $services,
            'parametres' => $parametres,
            'partenaires' => $partenaires,
        ]);
    }

    /**
     * Affiche la liste des services
     * 
     * @Route("/services", name="services")
     */
    public function services( )
    {

        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository(Service::class)->findAll();
        return $this->render('core/services.html.twig', [
            'services' => $services,
        ]);
    }

    /**
     * Affiche un service
     * 
     * @Route("/services/{service_slug}", name="service")
     */
    public function service($service_slug)
    {

        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository(Service::class)->findOneBySlug($service_slug);
        return $this->render('core/service.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * Affiche une liste de projet paginée
     * 
     * @Route("/projets/{page}", requirements ={"page"="\d+"}, name="projets")
     */
    public function projets($page=1)
    {
        $em = $this->getDoctrine()->getManager();
        $parametres = $em->getRepository(Parametres::class)->findOneByNom("options");
        $nbreDeProjetParPage = $parametres->getNombreDeProjetParPage();
        $projets = $em->getRepository(Projet::class)->rechercheTout($nbreDeProjetParPage, $page);
        $nbreDePage = ceil(count($projets) / $nbreDeProjetParPage);
        return $this->render('core/projets.html.twig', [
            'projets' => $projets,'nbreDePage' => $nbreDePage,'page' => $page,
        ]);
    }

    /**
     * Affiche un projet
     * 
     * @Route("/projets/{projet_slug} ", name="projet")
     */
    public function projet($projet_slug)
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

        $em = $this->getDoctrine()->getManager();
        $temoignages = $em->getRepository(Temoignages::class)->findAll();
        $faq = $em->getRepository(Faq::class)->findAll();
        $parametres = $em->getRepository(Parametres::class)->findOneByNom("options");

        return $this->render('core/apropos.html.twig', [
            'tem' => $temoignages,
            'faq' => $faq,
            'parametres' => $parametres,
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
