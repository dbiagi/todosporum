<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AnimappController extends Controller {
    
    /**
     * @Route("/animapp/", name="main_animapp")
     */
    public function editorAction(){
        return $this->render('Animapp/animapp.html.twig');
    }
}
