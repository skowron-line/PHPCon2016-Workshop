<?php


namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class WorkshopRepository extends EntityRepository
{
    public function isRegistrationClosed()
    {
        return false;
    }
}