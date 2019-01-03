<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * @Route("/formation/{id}",name="formation")
     */
    public function uneFormation($id)
    {
        $repositoryUneFormation = $this->getDoctrine()->getRepository(Formation::class)->find($id);
        return $this->render('pro_stage/uneFormation.html.twig', [
            'forma'=> $repositoryUneFormation,
            'idFormation'=>$id]);
    }

    /**
     * @Route("/recherche",name="Recherche")
     */
    public function rechercher(Request $request,Request $request2)
    {
        $form = $this->createFormBuilder(null)
        ->add('recherche', TextType::class)
        ->add('Rechercher une formation par l\'id', SubmitType::class)
        ->getForm();

        $task=$form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $recherche = $form->getData('recherche');
        $recherche = $recherche["recherche"];
        $repositoryUneFormation = $this->getDoctrine()->getRepository(Formation::class)->find($recherche);
        

        if ($repositoryUneFormation == true){
            return $this->redirectToRoute('formation', [
                'forma'=> $repositoryUneFormation,
                'idFormation'=>$repositoryUneFormation->getId(),
                'id'=>$repositoryUneFormation->getId()]);
        }
        elseif ($repositoryUneFormation != true) {
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
            return $this->redirectToRoute('Recherche');
            }
    }


    $form2 = $this->createFormBuilder(null)
    ->add('recherche', TextType::class)
    ->add('Rechercher un stage par l\'id', SubmitType::class)
    ->getForm();

    $task2=$form2->handleRequest($request2);

if ($form2->isSubmitted() && $form2->isValid()) {
    $recherche2 = $form2->getData('recherche');
    $recherche2 = $recherche2["recherche"];
    $repositoryUnStage = $this->getDoctrine()->getRepository(Stage::class)->find($recherche2);
    

    if ($repositoryUnStage == true){
        return $this->redirectToRoute('Stage', [
                'stage'=> $repositoryUnStage,
                'idStage'=>$repositoryUnStage->getId(),
                'id'=>$repositoryUnStage->getId()
                ]);
    }
    elseif ($repositoryUnStage != true) {
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
        return $this->redirectToRoute('Recherche');
        }
}

    
    return $this->render('pro_stage/recherche.html.twig', array(
        'form' => $form->createView(),
        'form2' => $form2->createView()
    )); 
}
}
