<?php


namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class ApplicationExists extends Constraint
{
    public $message = 'No application found for "%email%"';
}