<?php

namespace App\Repository;

use App\Entity\PostComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostComment[]    findAll()
 * @method PostComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostComment::class);
    }

    /**
    * @return PostComment[]
    */
    public function commentsByPageAndPost(int $page, int $pageLimit, int $postId) {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('pc')
                     ->from('App\Entity\PostComment', 'pc')
                     ->where('pc.post_id = :postId')
                     ->orderBy('pc.timestamp', 'DESC')
                     ->setMaxResults($pageLimit)
                     ->setFirstResult(($page - 1) * $pageLimit)
                     ->setParameter('postId', $postId);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
    * @return int
    */
    public function getCommentCountByPost(int $postId) {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('count(pc.id)')
                     ->from('App\Entity\PostComment', 'pc')
                     ->where('pc.post_id = :postId')
                     ->setParameter('postId', $postId);

        return intval($queryBuilder->getQuery()->getSingleScalarResult());
    }
}
