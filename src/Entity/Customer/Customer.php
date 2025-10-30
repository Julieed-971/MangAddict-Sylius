<?php

declare(strict_types=1);

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Customer as BaseCustomer;
<<<<<<< HEAD

#[ORM\Entity]
#[ORM\Table(name: 'sylius_customer')]
class Customer extends BaseCustomer
{
=======
use Sylius\Component\Core\Model\CustomerInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_customer')]
class Customer extends BaseCustomer implements CustomerInterface
{
    #[ORM\Column(type: "string", nullable: true)]
    private $grade;

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): void
    {
        $this->grade = $grade;
    }
>>>>>>> a8d294baf (Local files from sync backup)
}
