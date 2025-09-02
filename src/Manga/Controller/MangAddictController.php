<?php

namespace App\Manga\Controller;

use App\Manga\Service\MangAddictService;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

class MangAddictController extends AbstractController
{
    private CustomerContextInterface $customerContext;
        private MangAddictService $mangAddictService;
    public function __construct(
        private Environment $twig,
        CustomerContextInterface $customerContext,
        MangAddictService $mangAddictService
    ) {
        $this->customerContext = $customerContext;
        $this->mangAddictService = $mangAddictService;
    }
    
    public function index(): Response
    {
        $currentCustomer = $this->customerContext->getCustomer();
        $firstName = $currentCustomer->getFirstName();

        $greet = $this->mangAddictService->greet($firstName);
        return $this->render("mangaddict/index.html.twig", [
            'greet' => $greet,
        ]);
    }
}