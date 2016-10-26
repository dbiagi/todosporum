<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\Paginator;

/**
 * Base controller.
 */
class BaseController extends Controller {
    
    /**
     * Get entity repository.
     * @return EntityRepository
     */
    protected function getAnimationRepository() {
        return $this->get('main.animation_repository');
    }

    /**
     * 
     * @return Paginator
     */
    protected function getPaginator() {
        return $this->get('knp_paginator');
    }

}
