<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Workshop;
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
    public function listAction(Request $request)
    {
        return $this->render(
            'Workshop/list.html.twig',
            [

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
        return $this->render(
            'Workshop/register.html.twig',
            [
                'workshop' => $workshop,
            ]
        );
    }

    /**
     * @param Workshop $workshop
     * @param Request $request
     *
     * @return Response
     */
    public function attendeeAction(Workshop $workshop, Request $request)
    {
        return $this->render(
            'Workshop/attendee.html.twig',
            [
                'workshop' => $workshop,
            ]
        );
    }
}