<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Adresse;
use App\Entity\Entreprise;

class AdresseInfoController extends AbstractController
{
    /**
     * @Route("/adresseInfo/{idN}", name="creerAdresse")
     */
    public function afficherAdress($idN)
    {
        $entrepriseId = $this->getUser()->getEntreprise()->getId();

        $entreprise = $this->getDoctrine()
            		       ->getRepository(Entreprise::class)
            			   ->find($entrepriseId);
        return $this->render('adresseInfo/adresse.html.twig',[
            'entreprise' => $entreprise, 'idN' => $idN,
        ]);
    }

    /**
     * @Route("/afficherAdress/{idN}", name="adresseInfoo")
     */

    public function creerAdresse($idN, Request $request)
    {
        $adresse = new Adresse;
        $adresse->setLibelle($request->get('adresse'));
        $adresse->setCodePostal($request->get('codePostal'));
        $adresse->setVille($request->get('ville'));

        $entrepriseId = $this->getUser()->getEntreprise()->getId();

        $entreprise = $this->getDoctrine()
            		       ->getRepository(Entreprise::class)
            			   ->find($entrepriseId);

        $adresse->setEntreprise($entreprise);

        $manager = $this->getDoctrine()->getManager() ;
        $manager->persist($adresse);
        $manager->flush();
        return $this->redirectToRoute('afficherEmployes',['idN'=>$idN]);
    }
    
}
