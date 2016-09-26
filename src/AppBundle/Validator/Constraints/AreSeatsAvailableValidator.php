<?php


namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Workshop;
use AppBundle\Service\WorkshopService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class AreSeatsAvailableValidator extends ConstraintValidator
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
     * @param Workshop $workshop
     *
     * @param Constraint $constraint
     */
    public function validate($workshop, Constraint $constraint)
    {
        if ($workshop->getAvailableSeats() > $this->workshopService->seatsLeft($workshop)) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }

}