<?php

namespace App\Form;

use App\Entity\Manga;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MangaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('title')
        ->add('price')
        ->add('category')
        ->add('tags', EntityType::class, [
            'class' => Tag::class,
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true, // Checkboxes
            // ou 'expanded' => false, // Select dropdown
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Manga::class,
        ]);
    }
}