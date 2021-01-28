<?php

namespace App\EntityListener;

use App\Entity\Article;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UpdateEntityListener
{
    public function preUpdate(Article $article, LifecycleEventArgs $event)
        {
            $article->setUpdatedAt(new \DateTime());
        }
    }
    