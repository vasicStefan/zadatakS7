<?php
/**
 * Created by PhpStorm.
 * User: blank
 * Date: 11/16/16
 * Time: 2:02 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class deleteController extends Controller
{


    /**
     * @Route("/admin/delete/{event}", name="delete")
     */

    public function deleteAction(Event $event)
    {

        $em = $this->getDoctrine()->getManager();

        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('list');

    }
}