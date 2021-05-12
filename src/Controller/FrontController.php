<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET")
     */
    public function home()
    {
        return $this->render("pages/home/index.html.twig");
    }
}