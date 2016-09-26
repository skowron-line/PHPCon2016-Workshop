<?php


namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Application;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class ApplicationExistsValidator extends ConstraintValidator
{
    /**
     * @param Application $application
     * @param Constraint $constraint
     */
    public function validate($application, Constraint $constraint)
    {
        if (false === empty($application->getId())) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setParameter('%email%', $application->getEmail())
            ->addViolation();
    }

}