<?php

namespace DBiagi\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller {

	/**
	 * @Route("/", name="main_home")
	 * @return Response
	 */
	public function indexAction(){

	    throw new \Exception('Exceção aleatória');
		return $this->render('Pages/home.html.twig');
	}

	/**
	 * @Route("projeto", name="main_projeto")
	 * @return Response
	 */
    public function projetoAction(){
		return $this->render('Pages/projeto.html.twig');
    }

	/**
	 * @Route("/politica-de-privacidade-e-copyright", name="main_politica")
	 * @return Response
	 */
    public function politicaAction(){
    	return $this->render('Pages/termo.html.twig');
    }

	/**
	 * @Route("/termo", name="main_termo")
	 * @return Response
	 */
    public function termoAction(){
    	return $this->render('Pages/termo.html.twig');
    }
}
