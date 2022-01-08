<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Activite;
use App\Entity\Prestation;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(): Response
    {
        $entreprises = $this->getDoctrine()
                    ->getRepository(Entreprise::class)
                    ->findAll();
        $activites = $this->getDoctrine()
                    ->getRepository(Activite::class)
                    ->findAll();
        $prestations = $this->getDoctrine()
                    ->getRepository(Prestation::class)
                    ->findBy(array(),array('createdAt' => 'DESC'));
        return $this->render('acceuil/index.html.twig', [
            'entreprises' => $entreprises,
            'activites' => $activites,
            'prestations' => $prestations,
        ]);
    }

    /**
     * @Route("/LiensUtiles", name="LiensUtiles")
     */
    public function LiensUtiles(): Response
    {
        return $this->render('acceuil/LiensUtiles.html.twig');
    }

    /**
     * @Route("/Les_Étapes_pratiques_de_la_création_d’une_entreprise_SARL_au_Maroc", name="Les_Étapes_pratiques_de_la_création_d’une_entreprise_SARL_au_Maroc")
     */
    public function article1(): Response
    {
        return $this->render('acceuil/article1.html.twig');
    }

    /**
     * @Route("/Pourquoi_investir_au_Maroc", name="Pourquoi_investir_au_Maroc")
     */
    public function article2(): Response
    {
        return $this->render('acceuil/article2.html.twig');
    }

    /**
     * @Route("/#PlansDeTarification", name="PlansDeTarification")
     */
    public function PlansDeTarification(): Response
    {
    	return $this->redirect('http://127.0.0.1:8000/#PlansDeTarification');
    }
    
}
