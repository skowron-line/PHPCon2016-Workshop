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
     * @var Workshop
     */
    protected $workshop;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}