<?php


namespace AppBundle\Validator\Constraints;

use AppBundle\Form\Dto\RegisterDto;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class AlreadyRegisteredValidator extends ConstraintValidator
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param RegisterDto $registerDto
     * @param Constraint $constraint
     */
    public function validate($registerDto, Constraint $constraint)
    {
        if (null === $registerDto->getApplication()) {
            return;
        }

        $repository = $this->manager->getRepository('AppBundle:Attendee');

        $attendee = $repository->findOneBy(
            [
                'workshop' => $registerDto->getWorkshop(),
                'email' => $registerDto->getApplication()->getEmail(),
            ]
        );

        if (null === $attendee) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setParameter('%email%', $registerDto->getApplication()->getEmail())
            ->atPath('application')
            ->addViolation();
    }

}