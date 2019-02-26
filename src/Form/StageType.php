<?php

namespace App\Form;

use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder
            ->add('titre',TextType::class)
            ->add('description',TextareaType::class)    
            ->add('mail',EmailType::class)
            ->add('telephone',TelType::class)
            ->add('nomContact',TextType::class)
            ->add('entreprise',EntityType::class,[
                'class' => Entreprise::class,
                'choice_label' => 'nom',
                ])
            /* ->add('formation',EntityType::class,[
                'class' => Formation::class,
                'choice_label' => 'libelle',
                ])    */
           /*  ->add('formation', CollectionType::class, array(
                'entry_type'   => EntityType::class,
                'entry_options'  => array(
                    'class'      => 'Formation::class',
                    'choice_label' => 'libelle'
                ),)) */
                
            ->add('formation', CollectionType::class, [
                'entry_type' => FormationType::class,
                'allow_add' => true,
                'allow_delete' => false,
                'entry_options' => ['label' => false],
                ])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
