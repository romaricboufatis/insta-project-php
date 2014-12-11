<?php
/**
 * Created by PhpStorm.
 * User: Rodolphe
 * Date: 07/12/2014
 * Time: 17:38
 */

namespace Insta\PlanningBundle\Controller;

use Insta\PlanningBundle\Entity\Lesson;
use Insta\PlanningBundle\Entity\Oral;
use Insta\PlanningBundle\Form\LessonType;
use Insta\PlanningBundle\Form\OralType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ScheduleController extends Controller {

    function createLessonAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $lesson = new Lesson();
        $form = $this->createForm(new LessonType(), $lesson);

        $form->handleRequest($request);

        if ($form->isValid()) {

//            if ($form->get('periodicity')->getData()) {
//
//                $dateEnd = $form->get('dateEnd')->getData();
//
//            }
//              TODO : add assert on empty room, etc.
            $em->persist($lesson);
            $em->flush();


        }

        return $this->render('PlanningBundle:Schedule:create_schedule.html.twig', array( 'form'=>$form->createView() ));

    }

    function createOralAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $oral = new Oral();
        $form = $this->createForm(new OralType(), $oral);

        $form->handleRequest($request);

        if ($form->isValid()) {

//            var_dump($oral);die;

            $em->persist($oral);
            $em->flush();


        }

        return $this->render('PlanningBundle:Schedule:create_schedule.html.twig', array( 'form'=>$form->createView() ));

    }

} 