<?php

namespace App\MangaHome\Service;

class MangAddictService
{
    public function greet(string $firstName = ""): string {
        return 'Bienvenue sur MangAddict ' . $firstName;
    }
}