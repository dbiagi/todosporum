<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AnimationController extends Controller {

    /**
     * @Route("/galeria", name="animation_list")
     */
    public function listAction() {
        return $this->render('Animation/list.html.twig');
    }

}
