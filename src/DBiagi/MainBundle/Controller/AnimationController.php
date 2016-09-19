<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DBiagi\MainBundle\Entity\Animation;
use DBiagi\MainBundle\Form\AnimationType;

/**
 * Animation controller.
 *
 * @Route("/animation")
 */
class AnimationController extends Controller
{
    /**
     * Lists all Animation entities.
     *
     * @Route("/", name="animation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $animations = $em->getRepository('DBiagiMainBundle:Animation')->findAll();

        return $this->render('animation/index.html.twig', array(
            'animations' => $animations,
        ));
    }

    /**
     * Creates a new Animation entity.
     *
     * @Route("/new", name="animation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $animation = new Animation();
        $form = $this->createForm('DBiagi\MainBundle\Form\AnimationType', $animation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($animation);
            $em->flush();

            return $this->redirectToRoute('animation_show', array('id' => $animation->getId()));
        }

        return $this->render('animation/new.html.twig', array(
            'animation' => $animation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Animation entity.
     *
     * @Route("/{id}", name="animation_show")
     * @Method("GET")
     */
    public function showAction(Animation $animation)
    {
        $deleteForm = $this->createDeleteForm($animation);

        return $this->render('animation/show.html.twig', array(
            'animation' => $animation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Animation entity.
     *
     * @Route("/{id}/edit", name="animation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Animation $animation)
    {
        $deleteForm = $this->createDeleteForm($animation);
        $editForm = $this->createForm('DBiagi\MainBundle\Form\AnimationType', $animation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($animation);
            $em->flush();

            return $this->redirectToRoute('animation_edit', array('id' => $animation->getId()));
        }

        return $this->render('animation/edit.html.twig', array(
            'animation' => $animation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Animation entity.
     *
     * @Route("/{id}", name="animation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Animation $animation)
    {
        $form = $this->createDeleteForm($animation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($animation);
            $em->flush();
        }

        return $this->redirectToRoute('animation_index');
    }

    /**
     * Creates a form to delete a Animation entity.
     *
     * @param Animation $animation The Animation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Animation $animation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('animation_delete', array('id' => $animation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
