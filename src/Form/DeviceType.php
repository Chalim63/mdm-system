<?php

namespace App\Form;

use App\Entity\Device;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', NULL, [
                'label' => 'Značka',
            ])
            ->add('imei', NULL, [
                'label' => 'IMEI',
            ])
            ->add('serialNumber', NULL, [
                'label' => 'Sériové číslo',
            ])
            ->add('phoneNumber', NULL, [
                'label' => 'Telefonní číslo',
            ])
            ->add('googleAccount', NULL, [
                'label' => 'Google účet',
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Poznámka',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Stav',
                'choices' => [
                    'Používá se' => 'in_use',
                    'Poškozený' => 'damaged',
                    ' Opraven' => 'fixed',
                    'Vyřazen' => 'retired',
                ],
            ])
            ->add('assignedTo', NULL, [
                'label' => 'Přiřazeno',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
        ]);
    }
}
