<?php

namespace App\Controller;

use App\Entity\Animation;
use App\Entity\AnimationPart;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Animation controller.
 */
class AnimationController extends AbstractController
{
    private const ITENS_PER_PAGE = 12;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Paginator
     */
    private $paginator;

    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->paginator     = $paginator;
    }

    /**
     * @Route("/galeria", name="animation_list", methods={"get"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request)
    {
        $currentpage = $request->query->getInt('page', 1);

        $response = $this->render('Animation/list.html.twig', [
            'animations' => $this->getAnimations($currentpage),
        ]);

        $response->setSharedMaxAge(15 * 60);

        return $response;
    }

    /**
     * @param int $currentPage
     * @return Response
     */
    public function widgetAction($currentPage = 1)
    {
        $repo = $this->entityManager->getRepository(AnimationPart::class);

        $parts = $repo->findBy([], ['updatedAt' => 'DESC']);

        $response = $this->render('Animation/widget.html.twig', [
            'parts' => $this->paginator->paginate($parts, $currentPage, self::ITENS_PER_PAGE),
        ]);

        $response->setSharedMaxAge(15 * 60);

        return $response;
    }

    protected function getAnimations($currentpage)
    {
        $repo = $this->entityManager->getRepository(Animation::class);

        return $this->paginator->paginate($repo->findall(), $currentpage, self::ITENS_PER_PAGE);
    }
}
