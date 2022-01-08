<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EtatSynthese;
use App\Entity\FicheEntreprise;
use App\Entity\FicheFinanciere;
use App\Entity\StatsSynthese;
use App\Entity\StatutMa;
use App\Entity\StatutFr;
use App\Entity\FormeLegaleMa;
use App\Entity\FormeLegaleFr;
use App\Entity\CompteSocials;
use App\Entity\Entreprise;
use App\Entity\Ma;
use App\Entity\Fr;
use App\Entity\Nationalite;

class AttachmentsInfoController extends AbstractController
{
    /**
     * @Route("/attachmentsInfoMa/{idma}/{idN}", name="attachmentsInfoMa")
     */
    public function afficherAttachementMa($idma, $idN)
    {

        $formeLegaleMas = $this->getDoctrine()
            		       ->getRepository(FormeLegaleMa::class)
            			   ->findAll();

        return $this->render('attachmentsInfo/attachmentsMa.html.twig',[
            'formeLegaleMas' => $formeLegaleMas,
            'id' => $idma, 
            'idN' => $idN,
        ]);
    }

    /**
     * @Route("/attachmentsInfoFr/{idma}/{idN}", name="attachmentsInfoFr")
     */
    public function afficherAttachementFr($idma, $idN)
    {

        $formeLegaleFrs = $this->getDoctrine()
            		       ->getRepository(FormeLegaleFr::class)
            			   ->findAll();

        return $this->render('attachmentsInfo/attachmentsFr.html.twig',[
            'formeLegaleFrs' => $formeLegaleFrs,
            'id' => $idma, 
            'idN' => $idN,
        ]);
    }

    /**
     * @Route("/attachement/{idma}/{idN}", name="attachement")
     */
    public function formeLegale($idma, $idN, Request $request)
    {
        $formeLegaleMa = new FormeLegaleMa();
        $formeLegaleFr = new FormeLegaleFr();
        $etatSynthese = new EtatSynthese();
        $fichefinanciere = new FicheFinanciere();
        $statutsMa = new StatutMa();
        $statutsFr = new StatutFr();
        $compteSocials = new CompteSocials();
        $ficheEntreprise = new FicheEntreprise();

        $manager = $this->getDoctrine()->getManager();

        $nationalite = $this->getDoctrine()
            		       ->getRepository(Nationalite::class)
            			   ->find($idN);

        if ($nationalite->getLibelle() == 'Maroc')
        {

            $id = $request->get('formeLegale');

            $formeLegaleMa = $manager->getRepository(FormeLegaleMa::class)
                                    ->find($id);

            $ma = $this->getDoctrine()
                        ->getRepository(Ma::class)
                        ->find($idma);
            
            $formeLegaleMa->addMa($ma);

            $file1 = $request->files->get("etatsSynthese");
            $format_file1 = $file1->guessExtension();
            
            $file2 = $request->files->get("fichefinanciere"); 
            $format_file2 = $file2->guessExtension();
           
            $file3 = $request->files->get("statutsMa");
            $format_file3 = $file3->guessExtension();
            
            if (strtoupper($format_file1) == "PDF" && strtoupper($format_file2) == "PDF" && strtoupper($format_file3) == "PDF") {

                $file_name1 = md5(uniqid()) . '.' . $file1->guessExtension();
                $file1->move($this->getParameter("etatsSynthese_directory"), $file_name1);
                $etatSynthese->setLibelle($file_name1);

                $file_name2 = md5(uniqid()) . '.' . $file2->guessExtension();
                $file2->move($this->getParameter("fichefinanciere_directory"), $file_name2);
                $fichefinanciere->setLibelle($file_name2);

                $file_name3 = md5(uniqid()) . '.' . $file3->guessExtension();
                $file3->move($this->getParameter("statutMa_directory"), $file_name3);
                $statutsMa->setLibelle($file_name3);
                
                $ma = $this->getDoctrine()
                                    ->getRepository(Ma::class)
                                    ->find($idma);

                $etatSynthese->setMa($ma);
                    
                $fichefinanciere->setMa($ma);
                
                $statutsMa->setMa($ma);

                $fichefinanciere->setType($request->get('typeF'));

                $date1 = new \DateTime('@'.strtotime($request->get('date1').'0101'));
                $etatSynthese->setCreatedAt($date1);

                $date2 = new \DateTime('@'.strtotime($request->get('date2').'0101'));
                $fichefinanciere->setCreatedAt($date2);

                $date3 = new \DateTime('@'.strtotime($request->get('date3').'0101'));
                $statutsMa->setCreatedAt($date3);

            }else {
                return $this->redirectToRoute('attachmentsInfoMa');
            }

            $manager->persist($formeLegaleMa);
            $manager->persist($etatSynthese);
            $manager->persist($fichefinanciere);
            $manager->persist($statutsMa);
            $manager->flush();


            return $this->redirectToRoute('PlansDeTarification');

        }else if ($nationalite->getLibelle() == 'France') {

            $id = $request->get('formeLegale');

            $formeLegaleFr = $manager->getRepository(FormeLegaleFr::class)
                                    ->find($id);

            $fr = $this->getDoctrine()
                        ->getRepository(Fr::class)
                        ->find($idma);
            
            $formeLegaleFr->addFr($fr);

            $file1 = $request->files->get("ficheentreprise");
            $format_file1 = $file1->guessExtension();
            
            $file2 = $request->files->get("statutsFr"); 
            $format_file2 = $file2->guessExtension();
           
            $file3 = $request->files->get("compteSocials");
            $format_file3 = $file3->guessExtension();
            
            if (strtoupper($format_file1) == "PDF" && strtoupper($format_file2) == "PDF" && strtoupper($format_file3) == "PDF") {

                $file_name1 = md5(uniqid()) . '.' . $file1->guessExtension();
                $file1->move($this->getParameter("ficheEntreprise_directory"), $file_name1);
                $ficheEntreprise->setLibelle($file_name1);

                $file_name2 = md5(uniqid()) . '.' . $file2->guessExtension();
                $file2->move($this->getParameter("statutFr_directory"), $file_name2);
                $statutsFr->setLibelle($file_name2);

                $file_name3 = md5(uniqid()) . '.' . $file3->guessExtension();
                $file3->move($this->getParameter("compteSocials_directory"), $file_name3);
                $compteSocials->setLibelle($file_name3);
                
                $fr = $this->getDoctrine()
                                    ->getRepository(Fr::class)
                                    ->find($idma);

                $compteSocials->setFr($fr);
                    
                $ficheEntreprise->setFr($fr);
                
                $statutsFr->setFr($fr);

                $date1 = new \DateTime('@'.strtotime($request->get('date1').'0101'));
                $ficheEntreprise->setCreatedAt($date1);

                $date2 = new \DateTime('@'.strtotime($request->get('date2').'0101'));
                $statutsFr->setCreatedAt($date2);

                $date3 = new \DateTime('@'.strtotime($request->get('date3').'0101'));
                $compteSocials->setCreatedAt($date3);

            }else {
                return $this->redirectToRoute('attachmentsInfoFr');
            }

            $manager->persist($formeLegaleFr);
            $manager->persist($ficheEntreprise);
            $manager->persist($statutsFr);
            $manager->persist($compteSocials);
            $manager->flush();

            return $this->redirectToRoute('PlansDeTarification');

        }
    }
}
