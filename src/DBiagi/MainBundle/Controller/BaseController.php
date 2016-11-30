<?php

namespace DBiagi\MainBundle\Controller;

use DBiagi\MainBundle\Repository\AnimationRepository;
use Knp\Component\Pager\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Base controller.
 */
class BaseController extends Controller {
    
    /**
     * Get entity repository.
     * @return AnimationRepository
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
