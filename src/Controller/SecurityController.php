<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;


class SecurityController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $email = (new Email());
        }
    }
}
