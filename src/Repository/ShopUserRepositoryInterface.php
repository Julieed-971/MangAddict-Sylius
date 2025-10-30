<?php

declare(strict_types=1);

namespace App\Repository;

use DateTime;
use Sylius\Component\User\Repository\UserRepositoryInterface as BaseShopUserRepositoryInterface;

interface ShopUserRepositoryInterface extends BaseShopUserRepositoryInterface
{
    public function findInactiveUserSinceDate(DateTime $date): array;
}
