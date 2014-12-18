<?php

namespace Insta\PlanningBundle\Controller;

use Insta\PlanningBundle\Entity\Course;
use Insta\PlanningBundle\Entity\Schedule;
use Insta\PlanningBundle\Entity\Student;
use Insta\PlanningBundle\Entity\Teacher;
use Insta\PlanningBundle\Entity\Tutor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class PublicController
 * @package Insta\PlanningBundle\Controller
 */
class PublicController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('PlanningBundle:Default:index.html.twig');
    }

    /**
     * @param $month
     * @param $year
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function planningAction($month, $year) {

        $doctrine = $this->getDoctrine();
        $user = $this->getUser();

        if ($this->isGranted('ROLE_ADMIN')) {
            $schedules = $doctrine->getRepository('PlanningBundle:Schedule')->findAll();

        } elseif ($user instanceof Student) {
            if (!is_null($user->getPromotion())) {
                $schedules = array_merge(
                    $user->getPromotion()->getLessons()->toArray() ,
                    $user->getOrals()->toArray()
                );
            } else {
                $schedules = $user->getOrals()->toArray();
            }

        } elseif ($user instanceof Teacher) {
            $schedules = array();
            foreach ($user->getCourses() as $course) {
                /** @var Course $course */
                $schedules = array_merge($schedules, $course->getLessons()->toArray(), $course->getOrals()->toArray() );
            }
        } elseif ($user instanceof Tutor) {
            $schedules = array();
            foreach ($user->getStudents() as $student) {
                /** @var Student $student */

                if (!is_null($student->getPromotion())) {
                    $schedules = array_merge($schedules, $student->getPromotion()->getLessons()->toArray(), $student->getOrals()->toArray() );
                } else {
                    $schedules = $student->getOrals()->toArray();
                }

            }
        } else {

            return $this->render('PlanningBundle:Public:no_planning.html.twig');

        }


        /** @var Schedule[][] $schedulesByDate */
        $schedulesByDate = array();
        foreach ($schedules as $schedule) {
            if (!isset($schedulesByDate[$schedule->getDatetime()->format('Y-m-j')]))
                $schedulesByDate[$schedule->getDatetime()->format('Y-m-j')] = array();

            $schedulesByDate[$schedule->getDatetime()->format('Y-m-j')][] = $schedule;
        }

        return $this->render('PlanningBundle:Public:base_planning.html.twig', array(
            'schedules'=>$schedulesByDate,
            'service' => $this->get('planning.holidays'),
            'time' => \DateTime::createFromFormat('m-Y', $month."-".$year)->format('U')

        ));

    }

    /**
     * @param Schedule $schedule
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("schedule", options={"mapping":{"id" : "id"}})
     */
    public function showScheduleAction(Schedule $schedule) {

        return $this->render('PlanningBundle:Public:showSchedule.html.twig', array('schedule'=>$schedule));

    }
}
