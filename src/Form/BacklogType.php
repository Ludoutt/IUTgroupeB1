<?php

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Form;

use App\Entity\Backlog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BacklogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('type', ChoiceType::class, [
                'choices' => [
                   'Epic' => 'epic',
                    'User Story' => 'user_story',
                    'Functionality' => 'functionality',
                    'Bug' => 'bug',
                    'Technical Task' => 'technical_task',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Backlog::class,
        ]);
    }
}
