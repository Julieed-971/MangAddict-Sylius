<?php

namespace App\Repository;

use DateTime;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\UserRepository as BaseUserRepository;

class UserRepository extends BaseUserRepository
{
    public function findInactiveUserSinceDate(DateTime $date): array
    {
        $inactiveUsers = $this->createQueryBuilder('u')
            ->where('u.lastLogin IS NULL OR u.lastLogin <= :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
        return $inactiveUsers ? $inactiveUsers : [];
    }
}