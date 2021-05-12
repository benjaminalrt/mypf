<?php
namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\RealisationRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET")
     */
    public function home(RealisationRepository $rrepo)
    {
        $reas = $rrepo->findAll();
        $context["reas"] = $reas;
        return $this->render("pages/home/index.html.twig", $context);
    }

    /**
     * @Route("/test", name="emailtest")
     */
    public function test(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from(new Address('contact@benjaminalerte.fr','Benjamin Alerte'))
            ->to("benjamin.alrt@gmail.com")
            ->subject('Nouveau message')
            ->text('test');
        $mailer->send($email);
        dd("true");
    }
}