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
     * @Route("/",name="Accueil")
     */
    public function accueil()
    {
        return $this->render('pro_stage/Accueil.html.twig');
    }

    /**
     * @Route("/stages", name="liste_stages")
     */
    public function listeStages()
    {
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class)->findAll();
        return $this->render('pro_stage/ListeStage.html.twig', ['stage'=>$repositoryStages]);
    }

    /**
     * @Route("/entreprises",name="liste_entreprises")
     */
    public function listeEntrep()
    {
        $repositoryEntrep = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();
        return $this->render('pro_stage/ListeEntrep.html.twig', ['entreprise'=>$repositoryEntrep]);
    }

    /**
     * @Route("/formations",name="liste_formations")
     */
    public function listeFormations()
    {
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class)->findAll();
        return $this->render('pro_stage/ListeFormation.html.twig', ['formation'=>$repositoryFormation]);
        }

    /**
     * @Route("/stage/{id}",name="Stage")
     */
    public function unStage($id)
    {
        $repositoryUnStage = $this->getDoctrine()->getRepository(Stage::class)->find($id);
        return $this->render('pro_stage/unStage.html.twig', [
            'stage'=> $repositoryUnStage,
            'idStage'=>$id]);
    }

    /**
     * @Route("/entreprise/{id}",name="entreprise")
     */
    public function uneEntreprise($id)
    {
        $repositoryUneEntreprise = $this->getDoctrine()->getRepository(Entreprise::class)->find($id);
        return $this->render('pro_stage/uneEntrep.html.twig', [
            'entrep'=> $repositoryUneEntreprise,
            'idEntrep'=>$id]);
    }
}
