<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StartPageController extends AbstractController
{
    /**
     * @Route("/", name="app_startpage")
     */
    public function index(): Response
    {
        return $this->render('StartPage/index.html.twig');
    }
}
