<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Ma;
use App\Entity\Fr;
use App\Entity\Entreprise;
use App\Entity\Nationalite;

class NationaliteInfoController extends AbstractController
{
    /**
     * @Route("/NationaliteInfo/Ma/{idN}", name="NationaliteInfoMa")
     */
    public function NationaliteMa($idN)
    {
        $entrepriseId = $this->getUser()->getEntreprise();
        $id = $entrepriseId->getId();

        $entreprise = $this->getDoctrine()
            		       ->getRepository(Entreprise::class)
            			   ->find($id);
        return $this->render('nationaliteInfo/maInfo.html.twig',[
            'idN' => $idN,
        ]);
    }

    /**
     * @Route("/NationaliteInfo/Fr/{idN}", name="NationaliteInfoFr")
     */
    public function NationaliteFr($idN)
    {
        return $this->render('nationaliteInfo/frInfo.html.twig',[
            'idN' => $idN,
        ]);
    }

    /**
     * @Route("/afficherNationalite/{idN}", name="afficherNationalite")
     */
    public function creerNationalite($idN, Request $request)
    {

        $ma = new Ma();
        $fr = new Fr();

        $entrepriseId = $this->getUser()->getEntreprise();
        $id = $entrepriseId->getId();
        $nationaliteId = $entrepriseId->getNationalite();
                           
        $entreprise = $this->getDoctrine()
            		       ->getRepository(Entreprise::class)
            			   ->find($id);

        $nationalite = $this->getDoctrine()
            		       ->getRepository(Nationalite::class)
            			   ->find($idN);
        
        if ($nationalite->getLibelle() == "Maroc") {

            $ma->setRc($request->get('rc'))
                ->setIce($request->get('ice'))
                ->setMatriculation($request->get('matriculation'))
                ->setCapital($request->get('capital'))
                ->setNationalite($nationaliteId);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($ma);
            $manager->flush();

        return $this->redirectToRoute('afficheActivites',['idma'=>$ma->getId(),'idN' => $idN]);

        }
        
        else if ($nationalite->getLibelle() == "France") {
            
            $fr->setSiret($request->get('siret'));
            $fr->setSiren($request->get('siren'));
            $fr->setMatriculation($request->get('matriculation'));
            $fr->setNumTVA($request->get('numTVA'));
            $fr->setCapital($request->get('capital'));
            $fr->setNationalite($nationaliteId);

            $manager = $this->getDoctrine()->getManager() ;
            $manager->persist($fr);
            $manager->flush();

        return $this->redirectToRoute('afficheActivites',['idma'=>$fr->getId(),'idN'=>$idN]);
    
        }
        
    }

}
