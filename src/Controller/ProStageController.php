<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Entity\Formation;
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
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class)->findAll();
        return $this->render('pro_stage/ListeFormation.html.twig', ['formation'=>$repositoryFormation]);
    }

    /**
     * @Route("/stages",name="Stages")
     */
    public function ListeStages()
    {
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class)->findAll();
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class)->findAll();
        return $this->render('pro_stage/ListeStages.html.twig', ['stages'=>$repositoryStages]);
    }

    /**
     * @Route("/stages/{id}",name="UnStage")
     */
    public function unStage($id)
    {
        $repositoryUnStage = $this->getDoctrine()->getRepository(Stage::class)->find($id);
        return $this->render('pro_stage/unStage.html.twig', [
            'stage'=> $repositoryUnStage,
            'idStage'=>$id]);
    }

    /**
     * @Route("/entreprises/{id}",name="UneEntreprise")
     */
    public function UneEntreprise($id)
    {
        $repositoryUneEntreprise = $this->getDoctrine()->getRepository(Entreprise::class)->find($id);
        return $this->render('pro_stage/uneEntreprise.html.twig', [
            'entreprise'=> $repositoryUneEntreprise,
            'idEntreprise'=>$id]);
    }
}
