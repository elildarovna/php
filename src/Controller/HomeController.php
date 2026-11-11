<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $psychologists = [
            [
                'name' => 'Анна Миронова',
                'specialty' => 'Семейный психолог',
                'experience' => '8 лет практики',
                'initials' => 'АМ',
                'color' => 'peach',
            ],
            [
                'name' => 'Дмитрий Волков',
                'specialty' => 'Психолог, КПТ-терапевт',
                'experience' => '6 лет практики',
                'initials' => 'ДВ',
                'color' => 'blue',
            ],
            [
                'name' => 'Елена Сергеева',
                'specialty' => 'Детский и подростковый психолог',
                'experience' => '10 лет практики',
                'initials' => 'ЕС',
                'color' => 'green',
            ],
        ];

        return $this->render('home/index.html.twig', [
            'psychologists' => $psychologists,
        ]);
    }
}
