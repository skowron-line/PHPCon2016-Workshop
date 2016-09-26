<?php


namespace AppBundle\EventListeners;

use AppBundle\Events\AttendeeAddedEvent;
use AppBundle\Service\WorkshopService;
use AppBundle\WorkshopEvents;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class AttendeAddedSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var WorkshopService
     */
    private $workshopService;

    /**
     * @param EntityManager $manager
     * @param WorkshopService $workshopService
     */
    public function __construct(EntityManager $manager, WorkshopService $workshopService)
    {
        $this->manager = $manager;
        $this->workshopService = $workshopService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            WorkshopEvents::ATTENDEE_ADDED => ['disableRegistration'],
        ];
    }

    /**
     * @param AttendeeAddedEvent $event
     */
    public function disableRegistration(AttendeeAddedEvent $event)
    {
        $workshop = $event->getWorkshop();

        if ($workshop->getAvailableSeats() > $this->workshopService->seatsLeft($workshop)) {
            return;
        }

        $workshop->setDisplay(false);

        $this->manager->persist($workshop);
        $this->manager->flush();
    }
}