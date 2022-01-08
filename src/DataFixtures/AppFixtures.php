<?php

namespace App\DataFixtures;
use App\Entity\FormeLegaleMa;
use App\Entity\FormeLegaleFr;
use App\Entity\Activite;
use App\Entity\Utilisateur;
use App\Entity\Region;
use App\Entity\Nationalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
  private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
      $regions = array (
        array("Chaouia-Ouardigha","MA"),
        array("Doukkala-Abda","MA"),
        array("Fès-Boulemane","MA"),
        array("Gharb-Chrarda-Beni Hssen","MA"),
        array("Grand Casablanca","MA"),
        array("Guelmim-Es Semara","MA"),
        array("Laâyoune-Boujdour-Sakia el Hamra","MA"),
        array("Marrakech-Tensift-Al Haouz","MA"),
        array("Meknès-Tafilalet","MA"),
        array("L'Oriental","MA"),
        array("Oued ed Dahab-Lagouira","MA"),
        array("Rabat-Salé-Zemmour-Zaër","MA"),
        array("Souss-Massa-Drâa","MA"),
        array("Tadla-Azilal","MA"),
        array("Tanger-Tétouan","MA"),
        array("Taza-Al Hoceïma-Taounate","MA"),
        array("Auvergne-Rhône-Alpes","FR"),
        array("Bourgogne-Franche-Comté","FR"),
        array("Bretagne","FR"),
        array("Centre-Val de Loire","FR"),
        array("Corse","FR"),
        array("Grand Est","FR"),
        array("Hauts-de-France","FR"),
        array("Île-de-France","FR"),
        array("Normandie","FR"),
        array("Nouvelle-Aquitaine","FR"),
        array("Occitanie","FR"),
        array("Pays de la Loire","FR"),
        array("Provence-Alpes-Côte d'Azur","FR")
      );

    	$listeDesFormeLegaleMa = array (
  			array("Société à Responsabilité Limitée","SARL"),
  			array("Société Anonyme","SA"),
  			array("Société en Nom Collectif","SNC"),
  			array("Société en Commandite Simple","SCS"),
  			array("Société en Commandite par Actions","SCA")
		  );

    	$listeDesFormeLegaleFr = array (
  			array("Entreprise Individuelle","EI"),
  			array("Entreprise Individuelle à Responsabilité Limitée","EIRL"),
  			array("Société à Responsabilité Limitée","SARL"),
			  array("Entreprise Unipersonnelle à Responsabilité Limitée","EURL"),
  			array("Société d’Exercice Libéral à Responsabilité Limitée","SELARL"),
  			array("Société Anonyme","SA"),
			  array("Société par Actions Simplifiée","SAS"),
			  array("Société par Actions Simplifiée Unipersonnelle","SASU"),
  			array("Société en Nom Collectif","SNC"),
  			array("Société Anonyme","SA"),
  			array("Société Civile Professionnelle","SCP")
		  );
		  $listeDesActivites = array (
  			array("Customer Relationship Management","CRM"),
  			array("Information Technology Outsourcing","ITO"),
  			array("Business Process Outsourcing","BPO"),
			  array("Engineering Services Outsourcing","ESO"),
  			array("Knowledge Process Outsourcing","KPO")
		  );
      foreach ($regions as $key => $value) {
        $region = new Region();
        $region->setLibelle($regions[$key][0]);
        $region->setPays($regions[$key][1]);
        $manager->persist($region);
      }
		  foreach ($listeDesFormeLegaleMa as $key => $value) {
    		$formeLegaleMa = new FormeLegaleMa();
        $formeLegaleMa->setLibelle($listeDesFormeLegaleMa[$key][0]);
        $formeLegaleMa->setAbreviation($listeDesFormeLegaleMa[$key][1]);
        $manager->persist($formeLegaleMa);
    	}
    	foreach ($listeDesFormeLegaleFr as $key => $value) {
    		$formeLegaleFr = new FormeLegaleFr();
        $formeLegaleFr->setLibelle($listeDesFormeLegaleFr[$key][0]);
        $formeLegaleFr->setAbreviation($listeDesFormeLegaleFr[$key][1]);
        $manager->persist($formeLegaleFr);
    	}
    	foreach ($listeDesActivites as $key => $value) {
    		$activite = new Activite();
        $activite->setLibelle($listeDesActivites[$key][0]);
        $activite->setAbreviation($listeDesActivites[$key][1]);
        $manager->persist($activite);
    	}
      $nationaliteMa = new Nationalite();
      $nationaliteFr = new Nationalite();
      $nationaliteMa->setLibelle("Ma");
      $nationaliteFr->setLibelle("Fr");
      $manager->persist($nationaliteMa);
      $manager->persist($nationaliteFr);
       
      $utilisateur = new Utilisateur();
      $utilisateur->setNom("BEN ABDELKRIM");
      $utilisateur->setPrenom("Bader");
      $utilisateur->setPost("Stagiaire");
      $utilisateur->setEmail("bader@gmail.com");
      $utilisateur->setPassword($this->passwordEncoder->encodePassword(
        $utilisateur,
        'bader'
      ));
      $manager->persist($utilisateur);
    	$manager->flush();
    }
}
