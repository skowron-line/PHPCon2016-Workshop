<?php


namespace AppBundle\Form\Type;

use AppBundle\Entity\Attendee;
use AppBundle\Form\Transformer\WorkshopTransformer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class RegisterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('workshop', HiddenType::class)
            ->add('attendee')
            ->add('register', SubmitType::class)
            ->get('workshop')
            ->addModelTransformer(new WorkshopTransformer($options['entityManager']));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('entityManager')
            ->setAllowedValues(
                'entityManager',
                function ($value) {
                    return $value instanceof EntityManager;
                }
            )
            ->setDefaults
            (
                [
                    'data_class' => Attendee::class,
                ]
            );
    }

}
