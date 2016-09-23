<?php


namespace AppBundle\Twig\Extension;

use AppBundle\Entity\Workshop;
use AppBundle\Service\WorkshopService;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class WorkshopExtension extends \Twig_Extension
{
    /**
     * @var WorkshopService
     */
    private $workshopService;

    /**
     * @param WorkshopService $workshopService
     */
    public function __construct(WorkshopService $workshopService)
    {
        $this->workshopService = $workshopService;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('seatsLeft', [$this, 'seatsLeft']),
        ];
    }

    /**
     * @param Workshop $workshop
     *
     * @return int
     */
    public function seatsLeft(Workshop $workshop)
    {
        return $this->workshopService->seatsLeft($workshop);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'workshop';
    }

}