<?php
/**
 * Created by PhpStorm.
 * User: blank
 * Date: 11/16/16
 * Time: 2:10 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\EventAdd;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class addController extends Controller
{

    /**
     * @Route("/admin/add", name="add")
     */
    public function adminAction(Request $request)
    {
        $form = $this->createForm(EventAdd::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $event = $form->getData();

            $em->persist($event);

            $em->flush();

            return $this->redirectToRoute('list');
        }


        return $this->render('admin/add.html.twig', [
            'form' => $form->createView()]);
    }

}