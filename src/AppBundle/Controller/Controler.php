<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Event;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class Controler extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        $queryPlace = $em->createQuery('
            SELECT DISTINCT e.place
            FROM AppBundle\Entity\Event e
            GROUP  BY e.place
            ORDER BY e.place DESC');

        $places = $queryPlace->getResult();


        $queryBuilder = $em->getRepository('AppBundle:Event')->createQueryBuilder('e');
        if ($request->query->getAlnum('filter') || $request->query->getAlnum('time') || $request->query->getAlnum('place')) {

            $queryBuilder
                ->where('e.title LIKE :title AND e.time LIKE :time AND e.place LIKE :place')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%')
                ->setParameter('time', '%' . $request->query->getAlnum('time') . '%')
                ->setParameter('place', '%' . $request->query->getAlnum('place') . '%');
        }
        $query = $queryBuilder->getQuery();

        $paginator = $this->get('knp_paginator');

        $events = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)

        );

        return $this->render('default/index.html.twig', [
            'events' => $events, 'places' => $places
        ]);
    }


}
