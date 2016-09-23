<?php


namespace AppBundle\Service;

use AppBundle\Entity\Attendee;
use AppBundle\Entity\Workshop;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class WorkshopService
{
    /**
     * @var \AppBundle\Repository\WorkshopRepository|EntityRepository
     */
    private $attendeeRepository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->attendeeRepository = $entityManager->getRepository('AppBundle:Attendee');
    }

    /**
     * @param Workshop $workshop
     *
     * @return int
     */
    public function seatsLeft(Workshop $workshop)
    {
        $collection = new ArrayCollection($this->attendeeRepository->findAll());
        $attendees = $collection->filter(
            function (Attendee $attendee) use ($workshop) {
                return $attendee->getWorkshop()->getId() === $workshop->getId();
            }
        );

        return $workshop->getAvailableSeats() - $attendees->count();
    }
}