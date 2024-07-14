<?php

namespace App\Bibliotek;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreateBook extends AbstractType
{
    /**
     * Skapar ett formulär för att skapa en ny bok.
     * @param FormBuilderInterface $builder bygger formuläret.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title'])
            ->add('author', TextType::class, ['label' => 'Author'])
            ->add('isbn', TextType::class, ['label' => 'ISBN'])
            ->add('image', TextType::class, ['label' => 'Image'])
            ->add('save', SubmitType::class, ['label' => 'Create Book']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
