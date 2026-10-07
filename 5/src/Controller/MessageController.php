<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    #[Route('/messages', name: 'messages', methods: ['GET', 'POST'])]
    public function index(Request $request, MessageGenerator $messageGenerator): Response
    {
        if ($request->isMethod('GET')) {
            return $this->render('messages/form.html.twig');
        }

        $users = [];

        for ($index = 1; $index <= 3; $index++) {
            $name = trim((string) $request->request->get('name_'.$index, ''));
            $email = trim((string) $request->request->get('email_'.$index, ''));

            if ($name === '' || $email === '') {
                continue;
            }

            $users[] = [
                'name' => $name,
                'email' => $email,
            ];
        }

        $result = $messageGenerator->generate($users);

        return $this->render('messages/report.html.twig', [
            'result' => $result,
        ]);
    }
}
