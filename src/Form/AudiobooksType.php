<?php

namespace App\Form;

use App\Entity\Audiobooks;
use App\Entity\Authors;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Vich\UploaderBundle\Form\Type\VichFileType;


class AudiobooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')

            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
                'label' => 'Cover Image',
            ])

            ->add('authors', EntityType::class, [
                'class' => Authors::class,
                'choice_label' => function (Authors $author) {
                    return $author->getLastName() . ' ' . $author->getFirstName();
                },
            ])

            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Audiobooks::class,
        ]);
    }
}
