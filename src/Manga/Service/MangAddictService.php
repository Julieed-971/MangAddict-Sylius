<?php

namespace App\Manga\Service;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

class MangAddictService
{
    private TranslatorInterface $translator;
    public function __construct(
        TranslatorInterface $translator,
        Security $security
        )
    {
        $this->translator = $translator;
    }
    public function greet(string $firstName = ""): string {
        return $this->translator->trans('app.mangaddict_page.welcome', ['%firstName%' => $firstName
    ]);
    }
}