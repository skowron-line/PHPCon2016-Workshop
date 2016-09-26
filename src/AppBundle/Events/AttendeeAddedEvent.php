<?php


namespace AppBundle\Events;

use AppBundle\Entity\Attendee;
use AppBundle\Entity\Workshop;
use Symfony\Component\EventDispatcher\Event;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class AttendeeAddedEvent extends Event
{
    /**
     * @var Workshop
     */
    private $workshop;
    /**
     * @var Attendee
     */
    private $attendee;

    /**
     * @param Workshop $workshop
     * @param Attendee $attendee
     */
    public function __construct(Workshop $workshop, Attendee $attendee)
    {
        $this->workshop = $workshop;
        $this->attendee = $attendee;
    }

    /**
     * @return Workshop
     */
    public function getWorkshop()
    {
        return $this->workshop;
    }

    /**
     * @return Attendee
     */
    public function getAttendee()
    {
        return $this->attendee;
    }

}