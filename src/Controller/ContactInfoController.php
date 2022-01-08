<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use  App\Entity\Contact;
use  App\Entity\Entreprise; 
use  App\Entity\Utilisateur; 

class ContactInfoController extends AbstractController
{
    /**
     * @Route("/contactInfo/{idN}",name="afficherContact")
     */
    public function afficherContact($idN){
        $entrepriseId = $this->getUser()->getEntreprise()->getId();

        $entreprise = $this->getDoctrine()
            		       ->getRepository(Entreprise::class)
            			   ->find($entrepriseId);

        return $this->render('contactInfo/contact.html.twig',[
            'entreprise' => $entreprise, 'idN' => $idN,
        ]);
    }  

    /**
     * @Route("/contactInfo/{idN}/{id}/supprimer", name="contactDelet")
     */

    public function supprimerContact($idN, Contact $contact){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($contact);
        $manager->flush();
        return $this->redirectToRoute('afficherContact',[
            'idN' => $idN,
        ]);
    }

    /**
     * @Route("/contactInfoo/{idN}", name="contactInfo")
     */
    public function creerContact(Request $request, $idN){

        $contact = new Contact();
        $entreprise = new Entreprise();
        $utilisateur = new Utilisateur();

        $contact->setTelephone($request->get('tele'));
        $contact->setTelephone2($request->get('tele2'));
        $contact->setPost($request->get('post'));
        $contact->setEmail($request->get('email'));
        $contact->setResponsable($request->get('responsable'));
        
        $entrepriseId = $this->getUser()->getEntreprise()->getId();

        $entreprise = $this->getDoctrine()
            		       ->getRepository(Entreprise::class)
            			   ->find($entrepriseId);
                          

        $contact->setEntreprise($entreprise);

        try {
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();

        }catch(\Exception $e){

            $this->addFlash('erreur', 'Email ou numéro de téléphone déja existe!');
            return $this->redirectToRoute('afficherContact',['idN'=>$idN]);
        }
        $contact = $this->getDoctrine()
                            ->getRepository(Contact::class)
                            ->findBy(['id' => $entrepriseId]);
        return $this->redirectToRoute('afficherContact',['idN'=>$idN]);
    }

    /**
     * @Route("/contactInfooo/{idN}",name="pageSuivant")
     */
    public function pageSuivant($idN){

        return $this->redirectToRoute('creerAdresse',['idN'=>$idN]);
    }

}
