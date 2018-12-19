<?php

namespace App\Controller;

use App\Entity\Entreprise;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProStageController extends AbstractController
{
    /**
     * @Route("/pro/stage", name="pro_stage")
     */
    public function index()
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }

    /**
     * @Route("/",name="Accueil")
     */
    public function accueil()
    {
        return $this->render('pro_stage/Accueil.html.twig');
    }

    /**
     * @Route("/entreprises",name="Liste entreprises")
     */
    public function listeEntrep()
    {
        $repositoryEntrep = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();
        return $this->render('pro_stage/ListeEntrep.html.twig', ['entreprise'=>$repositoryEntrep]);
    }

    /**
     * @Route("/formations",name="Formations")
     */
    public function listeFormations()
    {
        return $this->render('pro_stage/ListeFormation.html.twig');
    }

    /**
     * @Route("/stage/{id}",name="Stage")
     */
    public function unStage($id)
    {
        return $this->render('pro_stage/unStage.html.twig',[
            'controller_name'=> 'ProStageController',
            'idStage'=>$id
        ]);
    }
}
