<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class participantsController extends Controller
{

    /**
     * @Route("/admin/participantsList/{event}", name="pList")
     */
    public function participantsAction(Event $event)
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('
                        SELECT DISTINCT f
                        FROM AppBundle\Entity\User f
                         join AppBundle\Entity\Participants p
                        WITH f.id=p.idUser
                        WHERE p.idEvent=:idEvent')
            ->setParameter('idEvent', $event->getId());
        $users = $query->getResult();


        return $this->render('admin/participantsList.html.twig', [
            'event' => $event, 'users' => $users
        ]);
    }


}