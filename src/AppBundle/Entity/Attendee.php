<?php


namespace AppBundle\Entity;

use AppBundle\Entity\Application;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class Attendee
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Application
     */
    protected $attendee;

    /**
     * @var Workshop
     */
    protected $workshop;
}