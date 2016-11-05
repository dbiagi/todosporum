<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller {
   
	public function homeAction(Request $request){
		$this->get('request');
	}
}
