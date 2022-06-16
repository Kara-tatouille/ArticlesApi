<?php

namespace App\EventListener;

use App\Entity\Article;
use App\Entity\Status;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;

class ArticleEventListener
{
    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof Article) {
                $this->handleArticleUpdate($entity, $uow);
                $uow->recomputeSingleEntityChangeSet($em->getClassMetadata(Article::class), $entity);
            }
        }
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Article) {
                $this->handleArticleInsertion($entity);
                $uow->recomputeSingleEntityChangeSet($em->getClassMetadata(Article::class), $entity);
            }
        }
    }

    /**
     * Will set the publication date to now if an article is being published
     */
    private function handleArticleUpdate(Article $article, UnitOfWork $unitOfWork)
    {
        $changeSet = $unitOfWork->getEntityChangeSet($article);
        if ($this->isArticleBeingPublished($changeSet)) {
            $article->setPublicationDate(new \DateTime('now'));
        }
    }

    /**
     * Will set the publication date to now if an article is created as published
     */
    private function handleArticleInsertion(Article $article)
    {
        if ($article->getStatus()?->getId() === Status::PUBLISHED) {
            $article->setPublicationDate(new \DateTime('now'));
        }
    }


    private function isArticleBeingPublished(array $changeSet): bool
    {
        if (!isset($changeSet['status'])) {
            return false;
        }
        $oldStatus = $changeSet['status'][0];
        $newStatus = $changeSet['status'][1];

        if (!$newStatus instanceof Status || !$oldStatus instanceof Status) {
            return false;
        }

        return
            $newStatus->getId() === Status::PUBLISHED
            && $newStatus->getId() !== $oldStatus->getId()
        ;
    }


}
