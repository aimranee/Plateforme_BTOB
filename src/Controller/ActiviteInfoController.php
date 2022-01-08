<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activite;
use App\Entity\Ma;
use App\Entity\Fr;
use App\Entity\Categorie;
use App\Entity\Entreprise;
use App\Entity\Nationalite;


class ActiviteInfoController extends AbstractController
{  
    /**
     * @Route("/activiteInfo/{idma}/{idN}", name="afficheActivites")
     */
    public function afficherActivite($idma,$idN)
    {
        $activites = $this->getDoctrine()
            		       ->getRepository(Activite::class)
            			   ->findAll(); 

        $categories = $this->getDoctrine()
            		       ->getRepository(Categorie::class)
            			   ->findAll(); 

        return $this->render('activiteInfo/activite.html.twig',[
            'activites' => $activites,'id' => $idma, 'idN' => $idN,'categories' => $categories,
        ]);
    }

    /**
     * @Route("/creerActivite/{idma}/{idN}", name="creerActivite")
     */
    public function creerActive($idma,$idN,Request $request)
    {
        $activite = new Activite();
        $categorie = new Categorie();
        
        $activite = $this->getDoctrine()
            		       ->getRepository(Activite::class)
            			   ->findAll(); 
        $entrepriseId = $this->getUser()->getEntreprise();
        $idNationalite = $entrepriseId->getNationalite();        

        $nationalite = $this->getDoctrine()
            		       ->getRepository(Nationalite::class)
            			   ->find($idN);

        
       $manager = $this->getDoctrine()->getManager();

       if ($nationalite->getLibelle() == 'Maroc') {
        $ma = $this->getDoctrine()
            		->getRepository(Ma::class)
            		->find($idma);
                                
            foreach ($request->get('activiteId') as $var1 => $value1) {

                
                foreach ($request->get('categorie') as $var2 => $value) 
                {
                    $categorie = $manager->getRepository(Categorie::class)
                                            ->find($value);
                    if ($categorie->getActivite()->getId() == $value1){
                    $ma->addCategorie($categorie);
                    
                    $manager->persist($categorie);
                    }
                }

                $activite = $manager->getRepository(Activite::class)
                                        ->find($value1);
                
                
                $activite->addMa($ma);
                $manager->persist($activite);
            }
            
            
            $manager->flush(); 
        return $this->redirectToRoute('attachmentsInfoMa',['idma'=>$idma,'idN'=>$idN]);
        }

        else if ($nationalite->getLibelle() == 'France') {
            
            $fr = $this->getDoctrine()
            		->getRepository(Fr::class)
            		->find($idma);
                        
                    foreach ($request->get('activiteId') as $var1 => $value1) {

                
                        foreach ($request->get('categorie') as $var2 => $value) 
                        {
                            $categorie = $manager->getRepository(Categorie::class)
                                                    ->find($value);
                            if ($categorie->getActivite()->getId() == $value1){
                            $fr->addCategorie($categorie);
                            
                            $manager->persist($categorie);
                            }
                        }
        
                        $activite = $manager->getRepository(Activite::class)
                                                ->find($value1);
                        
                        
                        $activite->addFr($fr);
                        $manager->persist($activite);
                    }

            $manager->flush(); 
        return $this->redirectToRoute('attachmentsInfoFr',['idma'=>$idma,'idN'=>$idN]);

        }

        
    }
}
