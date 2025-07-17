<?php

namespace App\MangaHome\Controller;

use App\MangaHome\Service\MangAddictService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

class MangAddictController extends AbstractController
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
        return $this->render("mangaddict/index.html.twig", [
            'greet' => $greet,
        ]);
    }
}