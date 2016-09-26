<?php


namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class IsPaid extends Constraint
{
    public $message = 'Application is not paid';
}