<?php


namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Application;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class IsPaidValidator extends ConstraintValidator
{
    /**
     * @param Application $application
     * @param Constraint $constraint
     */
    public function validate($application, Constraint $constraint)
    {
        if (null == $application->getId()) {
            return;
        }

        if (true === $application->isPaid()) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }

}