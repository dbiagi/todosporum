<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DBiagi\MainBundle\Controller\BaseController;

/**
 * Animation controller.
 */
class AnimationController extends BaseController
{
    protected $paginationLimit = 12;
    
    /**
     * @Route("/galeria", name="animation_list")
     */
    public function listAction(Request $request){
        $currentPage = $request->query->getInt('page', 1);
        $limit = 12;
        
        $repo = $this->getAnimationRepository();
        
        $paginator = $this->getPaginator();
        
        $pagination = $paginator->paginate(
            $repo->findAll(),
            $currentPage, 
            $this->paginationLimit
        );
        
        return $this->render('Animation/list.html.twig', [
            'animations' => $pagination
        ]);
    }
    
}
