<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

use App\Entity\Entreprise;
use App\Entity\Nationalite;
use App\Entity\Utilisateur;

class EntrepriseInfoController extends AbstractController
{
    /**
     * @Route("/entrepriseInfo",name="afficherEntreprise")
     */
    public function afficherEntreprise(){
        return $this->render('entrepriseInfo/entreprise.html.twig');
    }

    /**
     * @Route("/afficherEntreprise", name="entrepriseInfo")
     */
    public function entrepriseInfo(Request $request)
    {
        $entreprise = new Entreprise();
        $nationalite = new Nationalite();
        $utilisateur = new Utilisateur();

        $entreprise->setTypeCompte($request->get('typeCompte'))
                    ->setNom($request->get('nom'))
                    ->setSiteWeb($request->get('siteWeb'))
                    ->setPourcentageDesDonnes(0)
                    ->setEvaluation(0)
                    ->setDescription($request->get('description'));


        $icon = $request->files->get("icon");

        $format_icon = $icon->guessExtension();

        if (strtoupper($format_icon) == "PNG" || strtoupper($format_icon) == "JPEG" || strtoupper($format_icon) == "JPG") {

        $icon_name = md5(uniqid()) . '.' . $icon->guessExtension();
        $icon->move($this->getParameter("image_directory"), $icon_name);
        $entreprise->setIcon($icon_name);

        $userId = $this->getUser()->getId();
        $utilisateur = $this->getDoctrine()
                            ->getRepository(Utilisateur::class)
                            ->find($userId);
        $entreprise->setUtilisateur($utilisateur);
        
        }else {
            return $this->redirectToRoute('afficherEntreprise');
        }

        $national = $request->get('nationalite');

        $nationalite = $this->getDoctrine()
        ->getRepository(Nationalite::class)
        ->findOneBy(array('libelle'=>$national));

        $entreprise->setNationalite($nationalite);
        
        $manager = $this->getDoctrine()->getManager() ;
        $manager->persist($entreprise);
        $manager->flush();
        
        return $this->redirectToRoute('afficherContact', [
            'idN' => $entreprise->getNationalite()->getId(),
        ]);
    }
}
