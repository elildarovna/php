<?php

namespace App\Controller;

use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalendarController extends AbstractController
{
    #[Route(
        '/calendar/{format}/{month}',
        name: 'calendar',
        defaults: ['format' => 'table', 'month' => null],
        requirements: ['format' => 'table|list|weekends', 'month' => '\\d{1,2}']
    )]
    public function index(string $format, ?int $month): Response
    {
        $month = $month ?? (int) date('n');

        if ($month < 1 || $month > 12) {
            throw $this->createNotFoundException('Такого месяца нет');
        }

        $year = (int) date('Y');
        $date = new DateTimeImmutable("$year-$month-01");
        $daysCount = (int) $date->format('t');
        $firstWeekDay = (int) $date->format('N');
        $calendar = array_fill(0, $firstWeekDay - 1, null);

        for ($day = 1; $day <= $daysCount; $day++) {
            $calendar[] = $day;
        }

        while (count($calendar) % 7 !== 0) {
            $calendar[] = null;
        }

        $days = [];
        $weekDays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];

        for ($day = 1; $day <= $daysCount; $day++) {
            $dayNumber = (int) $date->setDate($year, $month, $day)->format('N');
            $days[] = ['number' => $day, 'name' => $weekDays[$dayNumber - 1]];
        }

        $monthNames = [
            1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ];

        return $this->render('calendar/index.html.twig', [
            'format' => $format,
            'month' => $month,
            'monthName' => $monthNames[$month],
            'year' => $year,
            'calendar' => array_chunk($calendar, 7),
            'days' => $days
        ]);
    }
}
