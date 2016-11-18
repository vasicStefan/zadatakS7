<?php
/**
 * Created by PhpStorm.
 * User: blank
 * Date: 11/16/16
 * Time: 1:59 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Participants;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class attendController extends Controller
{


    /**
     * @Route("/attend/{event}", name="attend")
     */

    public function attendAction(Event $event)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

//        $query = $em->createQuery('
//            SELECT DISTINCT p
//            FROM AppBundle\Entity\Participants p
//            WHERE p.idUser= :id');
//        $query->setParameters([
//            'id' => $user->getId()
//        ]);

        //$allreadyIn = $query->getResult();

//        if ($allreadyIn == null) {
            $participants = new Participants();
            $participants->setIdEvent($event->getId());
            $participants->setIdUser($user->getId());
            $em->persist($participants);
            $em->flush();
//        }
        return $this->redirectToRoute('list');

    }

}