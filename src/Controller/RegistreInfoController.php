<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Utilisateur;

class RegistreInfoController extends AbstractController
{
    /**
     * @Route("/inscription",name="afficherRegistre")
     */
    public function afficherInscription(){    
        $utilisateurs = $this->getDoctrine()
            		       ->getRepository(Utilisateur::class)
            			   ->findAll();
        return $this->render('registreInfo/registre.html.twig',[
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * @Route("/inscription1",name="registre")
     */
    public function regitre(Request $request, UserPasswordEncoderInterface $encoder): Response
    {              
            $utilisateur = new Utilisateur();
            $encoded = $encoder->encodePassword($utilisateur, $request->get('password'));
            $utilisateur->setNom($request->get('nom'))
                        ->setPrenom($request->get('prenom'))
                        ->setPost($request->get('post'))
                        ->setEmail($request->get('email'))
                        ->setPassword($encoded);   

            try {
                $manager = $this->getDoctrine()->getManager() ;
                $manager->persist($utilisateur);
                $manager->flush();
                return $this->redirectToRoute('app_login');

            }catch(\Exception $e){

                $this->addFlash('erreur', 'Email déja existe!');
                return $this->redirectToRoute('afficherRegistre');
            }
            
    }
}
