<?php


namespace AppBundle\Form\Transformer;

use AppBundle\Entity\Workshop;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class WorkshopTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Workshop $workshop
     *
     * @return int
     */
    public function transform($workshop)
    {
        if (false === ($workshop instanceof Workshop)) {
            return null;
        }

        return $workshop->getId();
    }

    /**
     * @param int $id
     *
     * @return Workshop|null
     */
    public function reverseTransform($id)
    {
        $repository = $this->manager->getRepository('AppBundle:Workshop');
        return $repository->find($id);
    }

}