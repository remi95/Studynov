<?php

namespace Sy\AgendaBundle\Repository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByGroups($groups)
    {
        $qry = $this-> createQueryBuilder('p')
            ->andWhere("p.group IN (:groups)")
            ->setParameter('groups', $groups)
            ->getQuery()
            ->getResult();

        return $qry;
    }

    public function findLastProjects($groups)
    {
        $qry = $this-> createQueryBuilder('p')
            ->andWhere("p.group IN (:groups)")
            ->setParameter('groups', $groups)
            ->setMaxResults(3)
            ->orderBy('p.date', 'DESC')
            ->getQuery()
            ->getResult();

        return $qry;
    }
}
