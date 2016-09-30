<?php


namespace AppBundle\Form\Type;

use AppBundle\Form\Dto\RegisterDto;
use AppBundle\Form\Transformer\EmailToApplicationTransformer;
use AppBundle\Form\Transformer\WorkshopTransformer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
            ->add(
                $builder
                    ->create('workshop', HiddenType::class)
                    ->addModelTransformer(new WorkshopTransformer($options['entityManager']))
            )
            ->add(
                $builder
                    ->create('application', EmailType::class)
                    ->addModelTransformer(new EmailToApplicationTransformer($options['entityManager']))
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
            ->setAllowedValues(
                'entityManager',
                function ($value) {
                    return $value instanceof EntityManager;
                }
            )
            ->setDefaults
            (
                [
                    'data_class' => RegisterDto::class,
                ]
            );
    }

}
