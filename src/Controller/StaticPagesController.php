<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticPagesController extends AbstractController
{
    /**
     * @Route("/", name="main_home", methods={"get"})
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('Pages/home.html.twig');
    }

    /**
     * @Route("projeto", name="main_projeto", methods={"get"})
     *
     * @return Response
     */
    public function projetoAction()
    {
        return $this->render('Pages/projeto.html.twig');
    }

    /**
     * @Route("/politica-de-privacidade-e-copyright", name="main_politica", methods={"get"})
     *
     * @return Response
     */
    public function politicaAction()
    {
        return $this->render('Pages/termo.html.twig');
    }

    /**
     * @Route("/termo", name="main_termo", methods={"get"})
     *
     * @return Response
     */
    public function termoAction()
    {
        return $this->render('Pages/termo.html.twig');
    }
}