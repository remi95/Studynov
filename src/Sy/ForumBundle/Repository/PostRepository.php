<?php

namespace Sy\ForumBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function findPosts($page, $nbPerPage){
        $qry = $this->createQueryBuilder('p')
            ->orderBy('p.date', 'DESC')
            ->getQuery();

        $qry->setFirstResult(($page-1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($qry, true);
    }

    public function findByCategory($category, $page, $nbPerPage){
        $qry = $this->createQueryBuilder('p')
            ->leftJoin('p.categories', 'c')
            ->addSelect('c')
            ->andWhere('c.slug = :category')
            ->setParameter('category', $category)
            ->orderBy('p.date', 'DESC')
            ->getQuery();

        $qry->setFirstResult(($page-1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($qry, true);
    }
}
