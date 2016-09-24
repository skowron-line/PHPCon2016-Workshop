<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Attendee;
use AppBundle\Entity\Workshop;
use AppBundle\Form\Type\CreateType;
use AppBundle\Form\Type\RegisterType;
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
    public function registerAction(Workshop $workshop)
    {
        $attendee = new Attendee();

        $registrationForm = $this->createForm(
            RegisterType::class,
            $attendee,
            [
                'entityManager' => $this->get('doctrine.orm.entity_manager'),
            ]
        );

        return $this->render(
            'Workshop/register.html.twig',
            [
                'workshop' => $workshop,
                'form' => $registrationForm->createView(),
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