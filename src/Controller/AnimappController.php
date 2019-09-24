<?php

namespace App\Controller;

use App\Entity\Animation;
use App\Entity\AnimationPart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AnimappController
 * @Route("/animapp")
 */
class AnimappController extends AbstractController {

    /**
     * @Route("/", name="new_animation", methods={"get"})
     */
    public function newAction() {
        return $this->render('Animapp/animapp.html.twig', [
            'save_url' => $this->generateUrl('save_animation'),
        ]);
    }

    /**
     * @param AnimationPart $part
     *
     * @Route("/{id}", requirements={"id"="\d+"}, name="edit_animation", methods={"get"})
     *
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
     * @Route("/{id}", name="save_animation", defaults={"id"=null}, methods={"post"})
     */
    public function saveAction(Request $request, $id) {
        $user = $this->getUser();

        $animation = null;

        if ($id) {
            $animation = $this->getDoctrine()->getRepository(Animation::class)->find($id);
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
            $this->get('logger')->error($e->getMessage(), [
                'exception' => $e->getTraceAsString(),
            ]);

            $request->getSession()->getFlashBag()->set('error', 'Erro ao gravar a animação tente novamente mais tarde.');
        }

        return $this->redirectToRoute('animation_list');
    }
}
