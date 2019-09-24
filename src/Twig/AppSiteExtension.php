<?php

namespace App\Twig;

use App\Twig\Widget\AnimationList;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppSiteExtension extends AbstractExtension
{
    /**
     * @var AnimationList
     */
    private $animationList;

    public function __construct(AnimationList $animationList)
    {
        $this->animationList = $animationList;
    }

    public function getFilters(): array
    {
        return [
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('widget_list_animations', [$this->animationList, 'create']),
        ];
    }
}
