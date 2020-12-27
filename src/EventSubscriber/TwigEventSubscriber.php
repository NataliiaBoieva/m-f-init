<?php

namespace App\EventSubscriber;

use App\Repository\ArticleRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $articleRepository;

    public function __construct(Environment $twig, ArticleRepository $articleRepository)
    {
        $this->twig = $twig;
        $this->articleRepository = $articleRepository;
    }
    public function onControllerEvent(ControllerEvent $event)
    {
        // ...
        $this->twig->addGlobal('articles', $this->articleRepository->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
