<?php


namespace AppBundle\Form\Dto;

use AppBundle\Entity\Application;
use AppBundle\Entity\Workshop;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class RegisterDto
{
    /**
     * @var Workshop
     */
    protected $workshop;

    /**
     * @var Application
     */
    protected $application;

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
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param Application $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }

}