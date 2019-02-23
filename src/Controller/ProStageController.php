<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Form\StageType;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/create/stage",name="createStage")
     */
    public function createStage(Request $request){
        $stage = new Stage();
        $form = $this->createForm(StageType::class,$stage);
        $form -> add('save',SubmitType::class,[
            'label' => 'Créer le stage',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $stage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $entityManager->persist($stage);

            $this->addFlash(
                'success',
                'Le stage a bien été créé.'
            );
            return $this->render('pro_stage/unStage.html.twig', [
                'idStage'=> $stage->getId(),
                'stage'=>$stage
            ]);
        }
    
    return $this->render('pro_stage/createStage.html.twig', [
        'form'=> $form->createView(),
        ]);
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
     * @Route("/create/entreprise",name="createEntreprise")
     */
    public function createEntrep(Request $request)
    {
        $entrep = new Entreprise();
        $form = $this->createForm(EntrepriseType::class,$entrep);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer une nouvelle entreprise',
            'attr' => ['class' => 'btn btn-default'],
        ]);


       /*  $form = $this->createFormBuilder($entrep)
            ->add('nom', TextType::class)
            ->add('activite', TextType::class)
            ->add('adresse')
            ->add('site')
            ->add('save', SubmitType::class, ['label' => 'Créer une nouvelle entreprise'])
            ->getForm();

 */
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                //récupérer dans $entrep les données submitted
                $entrep = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                $entityManager->persist($entrep);

                $this->addFlash(
                    'success',
                    'L\'entreprise a bien été créée.'
                );
                return $this->render('pro_stage/uneEntrep.html.twig', [
                    'id'=> $entrep->getId(),
                    'entrep'=>$entrep
                ]);
            }
        
        return $this->render('pro_stage/createEntrep.html.twig', [
            'form'=> $form->createView(),
            ]);
    }

    /**
     * @Route("/entreprise/{id}/edit",name="entreprise_edit")
     */
    public function edit(Entreprise $entrep, Request $request)
    {
        $form = $this->createForm(EntrepriseType::class,$entrep);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier l\'entreprise',
            'attr' => ['class' => 'btn btn-default'],
        ]);
        /* $form = $this->createFormBuilder($entrep)
            ->add('nom', TextType::class)
            ->add('activite', TextType::class)
            ->add('adresse')
            ->add('site', UrlType::class)
            ->add('save', SubmitType::class, ['label' => 'Modifier l\'entreprise'])
            ->getForm(); */


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                //récupérer dans $entrep les données submitted
                $entrep = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                $entityManager->persist($entrep);

                $this->addFlash(
                    'success',
                    'L\'entreprise a bien été modifiée.'
                );
                return $this->render('pro_stage/uneEntrep.html.twig', [
                    'id'=> $entrep->getId(),
                    'entrep'=>$entrep
                ]);
            }
        
        return $this->render('pro_stage/editEntrep.html.twig', [
            'form'=> $form->createView(),
            ]);
        
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
