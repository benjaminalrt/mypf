<?php
namespace App\Controller;

use App\Service\RecaptchaChecker;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\RealisationRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/contact-form", name="contact_form", methods="POST")
     */
    public function contact_form(MailerInterface $mailer, Request $request, RecaptchaChecker $checker)
    {
        $recaptcha = $request->request->get("g-recaptcha-response");
        $challenge = $checker->isValid($recaptcha);

        $recaptcha = $request->request->get("phone");

        if($challenge)
        {
            $arr = [];
            foreach($request->request as $field => $value)
            {
                $arr[$field] = $value;
            }
            $email = (new Email())
                ->from(new Address('contact@benjaminalerte.fr','Benjamin Alerte'))
                ->to("contact@benjaminalerte.fr")
                ->subject('Nouveau message')
                ->text(json_encode($arr));
            $mailer->send($email);
            $this->addFlash('success','Votre message a bien été reçu. Je reviendrais vers vous au plus vite !');
        }
        else
        {
            $this->addFlash('danger','Êtes-vous un robot ? :/ Votre score Google Captcha a été jugé trop faible.');
        }

        return $this->redirectToRoute("home", ["tab" => "tab-contact"]);
    }
}