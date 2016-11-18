<?php
/**
 * Created by PhpStorm.
 * User: blank
 * Date: 11/16/16
 * Time: 1:55 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class maxController extends Controller
{

    /**
     * @Route("/admin/max", name="max")
     */
    public function maxAction()
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('
            SELECT DISTINCT e, COUNT(p) as c
            FROM AppBundle\Entity\Event e
             join AppBundle\Entity\Participants p
            WITH e.id=p.idEvent 
            GROUP  BY e
            ORDER BY c DESC');

        $event = $query->getResult();


        return $this->render('admin/max.html.twig', [
            'event' => $event[0]
        ]);
    }


}