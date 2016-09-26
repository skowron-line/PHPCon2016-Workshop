<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Attendee;
use AppBundle\Entity\Speaker;
use AppBundle\Entity\Workshop;
use AppBundle\Events\AttendeeAddedEvent;
use AppBundle\Form\Dto\RegisterDto;
use AppBundle\Form\Type\CreateType;
use AppBundle\Form\Type\RegisterType;
use AppBundle\Form\Type\SpeakerType;
use AppBundle\WorkshopEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class WorkshopController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $workshop = new Workshop();
        $createForm = $this->createForm(
            CreateType::class,
            $workshop,
            [
                'entityManager' => $this->get('doctrine.orm.entity_manager'),
            ]
        );

        if (true === $request->isMethod('POST')) {
            $createForm->handleRequest($request);

            $workshop->setDisplay(true);

            $manager = $this
                ->getDoctrine()
                ->getManager();

            $manager->persist($workshop);
            $manager->flush();

            $this
                ->get('session')
                ->getFlashBag()
                ->add(
                    'success',
                    sprintf('Workshop "%s" successfully added', $workshop->getTitle())
                );

            return $this->redirectToRoute('list');
        }

        return $this->render(
            'Workshop/create.html.twig',
            [
                'createForm' => $createForm->createView(),
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function speakerAction(Request $request)
    {
        $speaker = new Speaker();
        $speakerForm = $this->createForm(SpeakerType::class, $speaker);

        if (true === $request->isMethod('POST')) {
            $speakerForm->handleRequest($request);

            $manager = $this
                ->getDoctrine()
                ->getManager();

            $manager->persist($speaker);
            $manager->flush();

            $this
                ->get('session')
                ->getFlashBag()
                ->add(
                    'success',
                    sprintf('Speaker "%s" successfully added', $speaker->getFullName())
                );

            return $this->redirectToRoute('list');
        }

        return $this->render(
            'Workshop/speaker.html.twig',
            [
                'speakerForm' => $speakerForm->createView(),
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request)
    {
        $workshops = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Workshop')
            ->findAll();

        return $this->render(
            'Workshop/list.html.twig',
            [
                'workshops' => $workshops,
            ]
        );
    }

    /**
     * @param Workshop $workshop
     * @param Request $request
     *
     * @return Response
     */
    public function workshopAction(Workshop $workshop, Request $request)
    {
        $template = 'workshop';
        if ('/_fragment' === $request->getPathInfo()) {
            $template = 'workshop_bare';
        }

        $attendees = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Attendee')
            ->findBy(
                [
                    'workshop' => $workshop,
                ]
            );

        return $this->render(
            sprintf('Workshop/%s.html.twig', $template),
            [
                'workshop' => $workshop,
                'attendees' => $attendees,
            ]
        );
    }

    /**
     * @param Workshop $workshop
     * @param Request $request
     *
     * @return Response
     */
    public function registerAction(Workshop $workshop, Request $request)
    {
        $registerDto = new RegisterDto();
        $registerDto->setWorkshop($workshop);

        $registrationForm = $this->createForm(
            RegisterType::class,
            $registerDto,
            [
                'entityManager' => $this->get('doctrine.orm.entity_manager'),
            ]
        );

        if (true === $request->isMethod('POST')) {

            $registrationForm->handleRequest($request);

            if (true === $registrationForm->isValid()) {

                $attendee = new Attendee();
                $attendee->setWorkshop($registerDto->getWorkshop());
                $attendee->setFirstName($registerDto->getApplication()->getFirstName());
                $attendee->setLastName($registerDto->getApplication()->getLastName());
                $attendee->setEmail($registerDto->getApplication()->getEmail());

                $manager = $this
                    ->getDoctrine()
                    ->getManager();

                $manager->persist($attendee);
                $manager->flush();

                $this
                    ->get('session')
                    ->getFlashBag()
                    ->add(
                        'success',
                        sprintf('You have been successfully registered to "%s" workshop', $workshop->getTitle())
                    );

                $this
                    ->get('event_dispatcher')
                    ->dispatch(WorkshopEvents::ATTENDEE_ADDED, new AttendeeAddedEvent($workshop, $attendee));

                return $this->redirectToRoute(
                    'workshop',
                    [
                        'id' => $workshop->getId(),
                    ]
                );
            }
        }

        return $this->render(
            'Workshop/register.html.twig',
            [
                'workshop' => $workshop,
                'registrationForm' => $registrationForm->createView(),
            ]
        );
    }

    /**
     * @param Workshop $workshop
     *
     * @return Response
     */
    public function attendeesAction(Workshop $workshop)
    {
        $attendees = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Attendee')
            ->findBy(
                [
                    'workshop' => $workshop,
                ]
            );

        return $this->render(
            'Workshop/attendee.html.twig',
            [
                'workshop' => $workshop,
                'attendees' => $attendees,
            ]
        );
    }
}