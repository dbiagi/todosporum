<?php

namespace App\Twig\Widget;

use App\Entity\Animation;
use App\Repository\AnimationRepository;
use Doctrine\ORM\EntityManagerInterface;

class AnimationList
{
    /**
     * @var AnimationRepository
     */
    private $animationRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->animationRepository = $entityManager->getRepository(Animation::class);
    }

    public function create(int $itensPerPage, bool $paginate)
    {

    }
}