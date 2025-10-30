<?php

namespace App\Manga\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class MangAddictService
{
    private TranslatorInterface $translator;
    
    public function __construct(
        TranslatorInterface $translator,
    )
    {
        $this->translator = $translator;
    }
    
    public function greet(string $firstName = ""): string {
        if ($firstName === '') {
            throw new \InvalidArgumentException('First name must not be empty.');
        }
        return $this->translator->trans(
            'app.mangaddict_page.welcome',
            ['%firstName%' => $firstName]
        );
    }
}