<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Prestation;
use App\Entity\Entreprise;
use App\Entity\Activite;
use App\Entity\Commentaire;
use App\Entity\AttachementPrestation;
use Symfony\Component\String\Slugger\SluggerInterface;

class PrestationController extends AbstractController
{

    function unique_multidimensional_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

    /**
     * @Route("/filtrerPrestations", name="filtrerPrestations")
     */
    public function filtrerPrestations(Request $request)
    {
        $nomEntrerprise = $request->get("nomEntrerprise");
        $activite = $request->get("activite");
        $prestations = $this->getDoctrine()
                    ->getRepository(Prestation::class)
                    ->findAll();
        $activites = $this->getDoctrine()
                    ->getRepository(Activite::class)
                    ->findAll();
        $entreprises = $this->getDoctrine()
                    ->getRepository(Entreprise::class)
                    ->findAll();
        // Nom D'entreprise :
        if ($nomEntrerprise != "" ) {
            $prestations = $this->getDoctrine()
                    ->getRepository(Prestation::class)
                    ->findAll();
            foreach ($prestations as $key1 => $prestation1) {
                if ($prestation1->getEntreprise()->getNom() != $nomEntrerprise) {
                    unset($prestations[$key1]);
                }
            }
        }
        // Activités :
        if ($activite != "" ) {
            $prestations2 = $this->getDoctrine()
                        ->getRepository(Prestation::class)
                        ->findBy(["activite" => $activite]);
            $prestationsTemporaire = [];
            foreach ($prestations as $key1 => $prestation1) {
                foreach ($prestations2 as $key2 => $prestation2) {
                    if ($prestation1->getId() == $prestation2->getId()) {
                        array_push($prestationsTemporaire,$prestation2);
                    }
                }
            }
            $prestations = $prestationsTemporaire;
        }

        
        return $this->render('prestation/tousLesPrestations.html.twig', [
            'prestations' => $prestations,
            'activites' => $activites,
            'entreprises' => $entreprises,
            'nomEntrerprise' => $nomEntrerprise,
            'activite' => $activite,
        ]);
    }

    /**
     * @Route("/toutesprestations", name="toutesprestations")
     */
    public function toutesprestations(): Response
    {
        $nomEntrerprise = "";
        $activite = "0";
    	$prestations = $this->getDoctrine()
                    ->getRepository(Prestation::class)
                    ->findAll();
        $activites = $this->getDoctrine()
                    ->getRepository(Activite::class)
                    ->findAll();
        $entreprises = $this->getDoctrine()
                    ->getRepository(Entreprise::class)
                    ->findAll();
        return $this->render('prestation/tousLesPrestations.html.twig', [
            'prestations' => $prestations,
            'activites' => $activites,
            'entreprises' => $entreprises,
            'nomEntrerprise' => $nomEntrerprise,
            'activite' => $activite,
        ]);
    }

    /**
     * @Route("/prestations", name="ListeDesPrestations")
     */
    public function prestations(): Response
    {
    	$prestations = $this->getDoctrine()
                    ->getRepository(Prestation::class)
                    ->findAll();
        return $this->render('prestation/prestations.html.twig', [
            'prestations' => $prestations,
        ]);
    }

    /**
     * @Route("/Nouvelle_prestation", name="NouvellePrestation")
     */
    public function NouvellePrestation(): Response
    {
        $activites = $this->getDoctrine()
                    ->getRepository(Activite::class)
                    ->findAll();
        return $this->render('prestation/nouvellePrestation.html.twig', [
            'activites' => $activites
        ]);
    }

    /**
     * @Route("/Publier_prestation", name="PublierPrestation")
     */
    public function PublierPrestation(Request $request, SluggerInterface $slugger)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $prestation = new Prestation();
    	$entreprise = $this->getDoctrine()
            			->getRepository(Entreprise::class)
            			->findOneBy(['id' => 1]);
        $activite = $this->getDoctrine()
                        ->getRepository(Activite::class)
                        ->findOneBy(['id' => $request->get("activite") ]);
        $prestation->addActivite($activite); 
    	$prestation->setEntreprise($entreprise);
    	$prestation->setTitre($request->get("titre"));
        $prestation->setPrixMin($request->get("prixMin"));
        $prestation->setPrixMax($request->get("prixMax"));
        $prestation->setDuree($request->get("duree"));
    	$varTexteArea = str_replace('\n', '<br />', nl2br($request->get("description")));
    	$prestation->setDescription($varTexteArea);
    	$prestation->setStatut("Active");
    	$prestation->setCreatedAt(new \DateTime('now'));

        $fichier = $request->files->get("attachementPrestation");
        if ($fichier) {
            $nomFichier = $fichier->getClientOriginalName();
            $nomFichier = $nomFichier.'-'.uniqid().'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter("attachementPrestation_directory"),$nomFichier);
            $attachementPrestation = new AttachementPrestation();
            $attachementPrestation->setLibelle($nomFichier);
            $attachementPrestation->setPrestation($prestation);
            $entityManager->persist($attachementPrestation);
        }
        $entityManager->persist($prestation);
        $entityManager->flush();
    	return $this->redirect($this->generateUrl('ListeDesPrestations'));
    }

    /**
     * @Route("/GérerLesCandidats/{idprestation}", name="GérerLesCandidats")
     */
    public function GererLesCandidats($idprestation): Response
    {
    	$prestation = $this->getDoctrine()
            			->getRepository(Prestation::class)
            			->findOneBy(['id' => $idprestation]);
        return $this->render('prestation/demandes.html.twig', [
            'prestation' => $prestation,
            'demandes' => $prestation->getDemandes(),
        ]);
    }

    /**
     * @Route("/prestationDetailsAdmin/{idprestation}", name="prestationDetails")
     */
    public function prestationDetails($idprestation): Response
    {
    	$prestation = $this->getDoctrine()
            			->getRepository(Prestation::class)
            			->findOneBy(['id' => $idprestation]);
        return $this->render('prestation/prestationDetail.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/prestationDetails/{idprestation}", name="prestationAfficherDetails")
     */
    public function prestationAfficherDetails($idprestation): Response
    {
    	$prestation = $this->getDoctrine()
            			->getRepository(Prestation::class)
            			->findOneBy(['id' => $idprestation]);
        return $this->render('prestation/prestationDetailClient.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/supprimerPrestation/{idprestation}", name="supprimerPrestation")
     */
    public function supprimerPrestation($idprestation): Response
    {
    	$prestation = $this->getDoctrine()
            		->getRepository(Prestation::class)
            		->findOneBy(['id' => $idprestation]);
		$entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($prestation);
        $entityManager->flush();
        return $this->redirect($this->generateUrl('ListeDesPrestations'));
    }

    /**
     * @Route("/modifierPrestation/{idprestation}", name="modifierPrestation")
     */
    public function modifierPrestation($idprestation): Response
    {
    	$prestation = $this->getDoctrine()
            		->getRepository(Prestation::class)
            		->findOneBy(['id' => $idprestation]);
        return $this->render('prestation/modifierPrestation.html.twig', [
            'prestation' => $prestation,
        ]);
        return $this->redirect($this->generateUrl('ListeDesPrestations'));
    }

    /**
     * @Route("/modifierPrestation1/{idprestation}", name="ModifierPrestation1")
     */
    public function modifierPrestation1($idprestation,Request $request): Response
    {
    	$prestation = $this->getDoctrine()
            			->getRepository(Prestation::class)
            			->findOneBy(['id' => $idprestation]);
    	$prestation->setTitre($request->get("titre"));
    	$varTexteArea = str_replace('\n', '<br />', nl2br($request->get("description")));
    	$prestation->setDescription($varTexteArea);
    	$prestation->setStatut("Active");
    	//$prestation->setCreatedAt(new \DateTime('now'));
    	$entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($prestation);
        $entityManager->flush();
    	return $this->redirect($this->generateUrl('ListeDesPrestations'));
    }

    /**
     * @Route("/mes_commentaires", name="mesCommentaires")
     */
    public function mesCommentaires(): Response
    {
        $commentaires = $this->getDoctrine()
                    ->getRepository(Commentaire::class)
                    ->findAll();
        return $this->render('prestation/mesCommentaires.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }

    /**
     * @Route("/supprimer_commentaire/{idcommentaire}", name="supprimerCommentaire")
     */
    public function supprimerCommentaire($idcommentaire): Response
    {
        $commentaire = $this->getDoctrine()
                    ->getRepository(Commentaire::class)
                    ->findOneBy(['id' => $idcommentaire]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($commentaire);
        $entityManager->flush();
        return $this->redirect($this->generateUrl('mesCommentaires'));
    }
}
