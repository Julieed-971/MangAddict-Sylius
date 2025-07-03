<?php

namespace App\Controller;

use App\Service\MangAddictService;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class MangAddictController
{
    private MangAddictService $mangAddictService;
    public function __construct(
        private Environment $twig,
        MangAddictService $mangAddictService
    ) {
        $this->mangAddictService = $mangAddictService;
    }
    
    public function index(string $firstName = "Julie"): Response
    {
        $greet = $this->mangAddictService->greet($firstName);
        return new Response($this->twig->render("mangaddict/index.html.twig", [
            'greet' => $greet,
        ]));
    }
}