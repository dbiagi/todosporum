<?php
namespace DBiagi\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Animation controller.
 */
class AnimationController extends BaseController {

    protected $paginationLimit = 12;

    /**
     * @Route("/galeria", name="animation_list")
     */
    public function listAction(Request $request) {
        $currentpage = $request->query->getInt('page', 1);

        $response = $this->render('Animation/list.html.twig', [
                'animations' => $this->getAnimations($currentpage),
            ]
        );

        $response->setSharedMaxAge(15 * 60);

        return $response;
    }

    protected function getAnimations($currentpage) {
        $repo = $this->getAnimationRepository();

        $paginator = $this->getPaginator();

        return $paginator->paginate($repo->findall(), $currentpage, $this->paginationLimit);
    }

    /**
     * @param int $currentPage
     * @return Response
     */
    public function widgetAction($currentPage = 1) {
        $repo = $this->getDoctrine()->getManager()->getRepository('DBiagiMainBundle:AnimationPart');

        $parts = $repo->findBy([], ['updatedAt' => 'DESC']);

        $response = $this->render('Animation/widget.html.twig', [
            'parts' => $this->getPaginator()->paginate($parts, $currentPage, $this->paginationLimit),
        ]);

        $response->setSharedMaxAge(15 * 60);

        return $response;
    }
}
