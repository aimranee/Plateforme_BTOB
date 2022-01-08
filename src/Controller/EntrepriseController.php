<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Entreprise;
use App\Entity\Commentaire;
use App\Entity\Utilisateur;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="entreprises")
     */
    public function entreprises(): Response
    {
    	$entreprises = $this->getDoctrine()
                    ->getRepository(Entreprise::class)
                    ->findAll();
        return $this->render('entreprise/entreprises.html.twig', [
            'entreprises' => $entreprises,
        ]);
    }

    /**
     * @Route("/entreprise/{idEntreprise}", name="entrepriseDetails")
     */
    public function entrepriseDetails($idEntreprise): Response
    {
        $commentaires = $this->getDoctrine()
                        ->getRepository(Commentaire::class)
                        ->findBy(['entreprise' => $idEntreprise]);
    	$entreprise = $this->getDoctrine()
            			->getRepository(Entreprise::class)
            			->findOneBy(['id' => $idEntreprise]);

        return $this->render('entreprise/entrepriseDetails.html.twig', [
            'entreprise' => $entreprise,
            'commentaires' => $commentaires,
        ]);
    }

    /**
     * @Route("/Publier_commentaire", name="PublierCommentaire")
     */
    public function PublierCommentaire(Request $request)
    {
        $nbrEtoile = 0;
        if ($request->get("rating") == 5) $nbrEtoile = 1;
        if ($request->get("rating") == 4) $nbrEtoile = 2;
        if ($request->get("rating") == 3) $nbrEtoile = 3;
        if ($request->get("rating") == 2) $nbrEtoile = 4;
        if ($request->get("rating") == 1) $nbrEtoile = 5;
        $entityManager = $this->getDoctrine()->getManager();
        $commentaire = new Commentaire();
        $entreprise = $this->getDoctrine()
                        ->getRepository(Entreprise::class)
                        ->findOneBy(['id' => $request->get("entreprise")]);
        $utilisateur = $this->getDoctrine()
                        ->getRepository(Utilisateur::class)
                        ->findOneBy(['id' => 1]);
        $commentaire->setObject($request->get("object"));
        $varTexteArea = str_replace('\n', '<br />', nl2br($request->get("commentaire")));
        $commentaire->setDescription($varTexteArea);
        $commentaire->setNbrEtoile($nbrEtoile);
        $commentaire->setEntreprise($entreprise);
        $commentaire->setUtilisateur($utilisateur);
        $commentaire->setCreatedAt(new \DateTime('now'));
        $entityManager->persist($commentaire);
        $entityManager->flush();
        return $this->redirectToRoute('entrepriseDetails', ['idEntreprise' => $entreprise->getId()]);
    }
}
