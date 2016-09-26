<?php


namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class AreSeatsAvailable extends Constraint
{
    public $message = 'No more seats available';
}