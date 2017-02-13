<?php

namespace DBiagi\MainBundle\Controller;

use DBiagi\MainBundle\Entity\Animation;
use DBiagi\MainBundle\Entity\AnimationPart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AnimappController
 * @Route("/animapp")
 */
class AnimappController extends Controller {

    /**
     * @Route("/", name="new_animation")
     * @Method("GET")
     */
    public function newAction() {
        return $this->render('Animapp/animapp.html.twig', [
            'save_url' => $this->generateUrl('save_animation'),
        ]);
    }

    /**
     * @param AnimationPart $part
     *
     * @Route("/{id}", requirements={"id"="\d+"}, name="edit_animation")
     * @return Response
     */
    public function editAction(AnimationPart $part) {
        return $this->render('Animapp/animapp.html.twig', [
            'part' => $part,
            'save_url'  => $this->generateUrl('save_animation', ['id' => $part->getAnimation()->getId()]),
        ]);
    }

    /**
     *
     * @param Request $request
     * @param         $id
     * @return RedirectResponse
     *
     * @Route("/{id}", name="save_animation", defaults={"id"=null})
     * @Method("POST")
     */
    public function saveAction(Request $request, $id) {
        $user = $this->getUser();

        $animation = null;

        if ($id) {
            $animation = $this->getDoctrine()->getRepository('DBiagiMainBundle:Animation')->find($id);
        }

        if (!$animation) {
            $animation = new Animation();
            $animation->setAuthor($user)
                ->setTitle($user->getFirstName());
        }

        $part = new AnimationPart();
        $part->setAuthor($user)
            ->setAnimation($animation)
            ->setContent($request->get('content'))
            ->setThumbnail($request->get('thumbnail'));

        $em = $this->getDoctrine()->getManager();

        try {
            $em->persist($animation);
            $em->persist($part);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->log($e->getMessage(), [
                'exception7' => $e->getTraceAsString(),
            ]);
            $request->getSession()->getFlashBag()->set('error', 'Erro ao gravar a animação tente novamente mais tarde.');
        }

        return $this->redirectToRoute('animation_list');
    }
}
