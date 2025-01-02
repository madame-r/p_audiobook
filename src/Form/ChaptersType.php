<?php

namespace App\Form;

use App\Entity\Audiobooks;
use App\Entity\Chapters;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Validator\Constraints\File;


class ChaptersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('chapter_order')
            ->add('duration')


            ->add('audiobooks', EntityType::class, [
                'class' => Audiobooks::class,
                'choice_label' => function (Audiobooks $audiobooks) {
                    // Concatenate the title and the author's name
                    return $audiobooks->getId(). ' . ' . $audiobooks->getTitle() . ' by ' . $audiobooks->getAuthors()->getFirstName() . ' ' . $audiobooks->getAuthors()->getLastName();
                },
            ])


            ->add('audioFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true, // Allow the user to delete the file
                'download_uri' => false, // Disable providing a link to download the file
                'label' => 'Upload Audio File',
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapters::class,
        ]);
    }
}
