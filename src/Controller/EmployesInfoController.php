<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Employes;
use App\Entity\Entreprise;
use App\Entity\Nationalite;


class EmployesInfoController extends AbstractController
{
    /**
     * @Route("/employesInfo/{idN}", name="afficherEmployes")
     */
    public function afficherEmployes($idN)
    {
        return $this->render('employesInfo/employes.html.twig',[
            'idN' => $idN,
        ]);
    }

    /**
     * @Route("/creerNbrEmployes/{idN}", name="employesInfoo")
     */
    public function employesInfo($idN,Request $request)
    {
        $employes = new Employes();
        $entreprise = new Entreprise();
        $nationalite = new Nationalite();

        $entrepriseId = $this->getUser()->getEntreprise()->getId();;
        
        $entreprise = $this->getDoctrine()
            		       ->getRepository(Entreprise::class)
            			   ->find($entrepriseId);

        $nationalite = $this->getDoctrine()
            		       ->getRepository(Nationalite::class)
            			   ->find($idN);

        $employes->setPlusBacPlus5($request->get('plusBacPlus5'))
                ->setBacPlus5($request->get('bacPlus5'))
                ->setBacPlus4($request->get('bacPlus4'))
                ->setBacPlus3($request->get('bacPlus3'))
                ->setBacPlus2($request->get('bacPlus2'))
                ->setBacOuMoin($request->get('bacOuMoin'))
                ->setEntreprise($entreprise)
                ->setTotal($request->get('plusBacPlus5') + $request->get('bacPlus5') + $request->get('bacPlus4') + $request->get('bacPlus3') + $request->get('bacPlus2') + $request->get('bacOuMoin'));

        $manager = $this->getDoctrine()->getManager() ;
        $manager->persist($employes);
        $manager->flush();

        if ($nationalite->getLibelle() == 'Maroc')
            return $this->redirectToRoute('NationaliteInfoMa',['idN'=>$idN]);
        else if ( $nationalite->getLibelle() == 'France' )
            return $this->redirectToRoute('NationaliteInfoFr',['idN'=>$idN]);
        
    }

}  
