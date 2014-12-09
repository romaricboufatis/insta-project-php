<?php

namespace Insta\PlanningBundle\Controller;

use Insta\PlanningBundle\Entity\Schedule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    public function indexAction()
    {
        return $this->render('PlanningBundle:Default:index.html.twig');
    }

    public function planningAction($month, $year) {

        $schedules = $this->getDoctrine()->getRepository('PlanningBundle:Schedule')->findAll();
        $holidays = $this->get('planning.holidays')->getHolidays($year);
        /** @var Schedule[] $schedulesByDate */
        $schedulesByDate = array();
        foreach ($schedules as $schedule) {
            if (!isset($schedulesByDate[$schedule->getDatetime()->format('Y-m-d')]))
                $schedulesByDate[$schedule->getDatetime()->format('Y-m-d')] = array();

            $schedulesByDate[$schedule->getDatetime()->format('Y-m-d')] = $schedule;
        }

        return $this->render('PlanningBundle:Public:base_planning.html.twig', array(
            'schedules'=>$schedulesByDate,
            'holidays'=>$holidays,
            'service' => $this->get('planning.holidays'),
            'time' => \DateTime::createFromFormat('m-Y', $month."-".$year)->format('U')

        ));

    }
}
