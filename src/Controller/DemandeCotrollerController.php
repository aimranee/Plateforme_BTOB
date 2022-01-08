<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Prestation;
use App\Entity\Entreprise;
use App\Entity\Demande;
use App\Entity\AttachementDemande;


class DemandeCotrollerController extends AbstractController
{
    /**
     * @Route("/postuler_Formaulaire/{idprestation}", name="postulerFormaulaire")
     */
    public function postulerFormaulaire($idprestation): Response
    {
    	$prestation = $this->getDoctrine()
            			->getRepository(Prestation::class)
            			->findOneBy(['id' => $idprestation]);
        return $this->render('demande/index.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/postuler_Demande_Submission", name="postulerDemandeSubmission")
     */
    public function PublierPrestation(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entreprise = $this->getDoctrine()
            			->getRepository(Entreprise::class)
            			->findOneBy(['id' => 1]);
        $prestation = $this->getDoctrine()
            			->getRepository(Prestation::class)
            			->findOneBy(['id' => $request->get("prestationId")]);
        $demande = new Demande();
    	$demande->setTitre($request->get("titre"));
    	$demande->setEntreprise($entreprise);
    	$varTexteArea = str_replace('\n', '<br />', nl2br($request->get("description")));
    	$demande->setDescription($varTexteArea);
    	$demande->setEtat("EnAttente");
    	$demande->setCreatedAt(new \DateTime('now'));
    	$demande->setPrestation($prestation);

        $fichier = $request->files->get("attachementDeamnde");
        if ($fichier) {
            $nomFichier = $fichier->getClientOriginalName();
            $nomFichier = $nomFichier.'-'.uniqid().'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter("attachementDemande_directory"),$nomFichier);
            $attachementDemande = new AttachementDemande();
            $attachementDemande->setLibelle($nomFichier);
            $attachementDemande->setDemande($demande);
            $entityManager->persist($attachementDemande);
        }
        $entityManager->persist($demande);
        $entityManager->flush();
        die("Votre demande a été envoyée avec succes");
    	return $this->redirect($this->generateUrl('ListeDesPrestations'));
    }

    /**
     * @Route("/demandeDétails/{idDemande}", name="demandeDétails")
     */
    public function demandeDetails($idDemande): Response
    {
    	$demande = $this->getDoctrine()
            			->getRepository(Demande::class)
            			->findOneBy(['id' => $idDemande]);

        return $this->render('demande/demandeDetails.html.twig', [
            'demande' => $demande,
        ]);
    }

    /**
     * @Route("/demandeChangeEtat/{idDemande}/{etat}", name="demandeChangeEtat")
     */
    public function demandeChangeEtat($idDemande,$etat): Response
    {
        $demande = $this->getDoctrine()
                        ->getRepository(Demande::class)
                        ->findOneBy(['id' => $idDemande]);
        ($etat == "Approuver") ? $demande->setEtat("Approuver")
         : $demande->setEtat("Refuser");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($demande);
        $entityManager->flush();
        return $this->redirectToRoute('GérerLesCandidats', ['idprestation' => $demande->getPrestation()->getId()]);
    }

    /**
     * @Route("/mesDemandes", name="mesDemandes")
     */
    public function mesDemandes(): Response
    {
        $demandes = $this->getDoctrine()
                        ->getRepository(Demande::class)
                        ->findAll();

        return $this->render('demande/demandes.html.twig', [
            'demandes' => $demandes,
        ]);
    }
}
