<?php

namespace App\EntityListener;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\ArticleController;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UpdateEntityListener
{
    public function preUpdate(Article $article, LifecycleEventArgs $event)
        {
            $article->setCreatedAt = new \DateTime();
        }
    }
    