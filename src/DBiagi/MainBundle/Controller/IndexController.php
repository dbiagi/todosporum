<?php

namespace DBiagi\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller {
   
	public function homeAction(Request $request){

	}

    /**
     * @Route("/test")
     */
	public function testAction(Request $request){
	    $msg = $request->query->get('msg', 'nada de nada de nada de nade de seu madruga');
	    $this->get('logger')->error($msg, [
	        'exception' => new \Exception('Isso é uma exceção')
        ]);

	    return new Response($msg);
    }
}
