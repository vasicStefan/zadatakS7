<?php
/**
 * Created by PhpStorm.
 * User: blank
 * Date: 11/16/16
 * Time: 2:04 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\EventAdd;

class editController extends Controller
{

    /**
     * @Route("/admin/edit/{event}", name="edit")
     */

    public function editAction(Request $request, Event $event)
    {

        $form = $this->createForm(EventAdd::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('list');
        }


        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()]);


    }

}