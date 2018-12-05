<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('pro_stage/ListeEntrep.html.twig');
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
