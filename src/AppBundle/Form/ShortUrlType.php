<?php

namespace AppBundle\Form;

use AppBundle\Document\ShortUrl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShortUrlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('originalUrl', TextType::class, [
            'required' => true,
        ])->add('expiresAt', DateType::class, [
            'widget' => 'single_text',
            'required' => false,
            'label' => 'Срок жизни (необязательно)',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShortUrl::class
        ]);
    }
}