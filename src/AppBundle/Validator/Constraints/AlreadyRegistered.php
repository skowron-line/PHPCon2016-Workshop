<?php


namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class AlreadyRegistered extends Constraint
{
    public $message = 'Email "%email%" already registered to this workshop';

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}