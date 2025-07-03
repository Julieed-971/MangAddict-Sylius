<?php

namespace App\Service;

class MangAddictService
{
    public function greet(string $firstName = ""): string {
        return 'Bienvenue sur MangAddict ' . $firstName;
    }
}