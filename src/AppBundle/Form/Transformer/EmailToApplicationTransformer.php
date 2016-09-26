<?php


namespace AppBundle\Form\Transformer;

use AppBundle\Entity\Application;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class EmailToApplicationTransformer implements DataTransformerInterface
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
     * @param null|Application $application
     *
     * @return string
     */
    public function transform($application)
    {
        if (false === ($application instanceof Application)) {
            return null;
        }

        return $application->getEmail();
    }

    /***
     * @param string $email
     *
     * @return Application
     */
    public function reverseTransform($email)
    {
        $applicationRepository = $this->manager->getRepository('AppBundle:Application');
        $application = $applicationRepository->findOneBy(
            [
                'email' => $email,
            ]
        );

        if (true === empty($application)) {
            $application = new Application();
            $application->setEmail($email);
        }

        return $application;
    }
}