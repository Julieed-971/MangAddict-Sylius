<?php

namespace App\Manga\Service;

<<<<<<< HEAD
use Symfony\Bundle\SecurityBundle\Security;
=======
>>>>>>> a8d294baf (Local files from sync backup)
use Symfony\Contracts\Translation\TranslatorInterface;

class MangAddictService
{
    private TranslatorInterface $translator;
    public function __construct(
        TranslatorInterface $translator,
<<<<<<< HEAD
        Security $security
=======
>>>>>>> a8d294baf (Local files from sync backup)
        )
    {
        $this->translator = $translator;
    }
    public function greet(string $firstName = ""): string {
<<<<<<< HEAD
        return $this->translator->trans('app.mangaddict_page.welcome', ['%firstName%' => $firstName
    ]);
=======
        if ($firstName === '') {
            throw new \InvalidArgumentException('First name must not be empty.');
        }
        return $this->translator->trans(
            'app.mangaddict_page.welcome',
            ['%firstName%' => $firstName]
        );
>>>>>>> a8d294baf (Local files from sync backup)
    }
}