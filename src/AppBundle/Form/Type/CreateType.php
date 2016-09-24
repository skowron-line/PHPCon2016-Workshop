<?php


namespace AppBundle\Form\Type;

use AppBundle\Entity\Speaker;
use AppBundle\Entity\Workshop;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class CreateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('availableSeats')
            ->add(
                'startsAt',
                DateTimeType::class,
                [
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('duration')
            ->add(
                'speaker',
                EntityType::class,
                [
                    'class' => Speaker::class,
                    'choice_label' => 'fullName',
                ]
            )
            ->add('submit', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('entityManager')
            ->addAllowedValues(
                'entityManager',
                function ($value) {
                    return $value instanceof EntityManager;
                }
            )
            ->setDefaults(
                [
                    'data_class' => Workshop::class,
                ]
            );
    }


}