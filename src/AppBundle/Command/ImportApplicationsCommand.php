<?php


namespace AppBundle\Command;

use AppBundle\Entity\Application;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Finder\Finder;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class ImportApplicationsCommand extends Command
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param Container $container
     * @param EntityManager $entityManager
     */
    public function __construct(Container $container, EntityManager $entityManager)
    {
        parent::__construct(null);

        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('applications:import')
            ->setDescription('Import application from CSV to database');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $files = $finder->files()->in(sprintf('%s/../', $this->container->getParameter('kernel.root_dir')));

        foreach ($files as $file) {
            if ('applications.csv' !== $file->getFilename()) {
                continue;
            }

            $this->parseFile($file->getPathname());
        }
    }

    /**
     * @param $filePath
     *
     * @return void
     */
    private function parseFile($filePath)
    {
        $lines = file($filePath);

        foreach ($lines as $line) {
            list(, $firstName, $lastName, $email, $isPaid) = explode(';', $line);

            $application = new Application();
            $application->setFirstName($firstName);
            $application->setLastName($lastName);
            $application->setEmail($email);
            $application->setIsPaid((boolean)$isPaid);

            $this->entityManager->persist($application);
            $this->entityManager->flush();
        }
    }
}