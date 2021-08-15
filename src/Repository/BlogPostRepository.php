<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    /**
    * @return BlogPost[]
    */
    public function postsByPage(int $page, int $pageLimit, bool $showArchived = false) {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('bp')
                     ->from('App\Entity\BlogPost', 'bp')
                     ->orderBy('bp.published_at', 'DESC')
                     ->setMaxResults($pageLimit)
                     ->setFirstResult(($page - 1) * $pageLimit);

        if (!$showArchived) {
            $queryBuilder->where('bp.archived = 0');
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
    * @return int
    */
    public function getPostCount(bool $showArchived = false) {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('count(bp.id)')
                     ->from('App\Entity\BlogPost', 'bp');

        if (!$showArchived) {
            $queryBuilder->where('bp.archived = 0');
        }

        return intval($queryBuilder->getQuery()->getSingleScalarResult());
    }
}
