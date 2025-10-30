<?php

declare(strict_types=1);

namespace App\Form\Extension;

use Sylius\Bundle\AdminBundle\Form\Type\CustomerType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Adding new fields works just like in the parent form type.
            ->add('grade', TextType::class, [
                'required' => false,
                'label' => 'Grade',
            ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [CustomerType::class];
    }
}