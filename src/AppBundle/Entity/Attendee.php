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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \AppBundle\Entity\Application
     */
    public function getAttendee()
    {
        return $this->attendee;
    }

    /**
     * @param \AppBundle\Entity\Application $attendee
     */
    public function setAttendee($attendee)
    {
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
     * @param Workshop $workshop
     */
    public function setWorkshop($workshop)
    {
        $this->workshop = $workshop;
    }

}