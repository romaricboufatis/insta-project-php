<?php
/**
 * Created by PhpStorm.
 * User: Rodolphe
 * Date: 07/12/2014
 * Time: 18:05
 */

namespace Insta\PlanningBundle\Controller;


use Insta\PlanningBundle\Entity\Student;
use Insta\PlanningBundle\Entity\Teacher;
use Insta\PlanningBundle\Entity\Tutor;
use Insta\PlanningBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    const  TYPE_USER = 'user';
    const  TYPE_STUDENT = 'student';
    const  TYPE_TUTOR = 'tutor';
    const  TYPE_TEACHER = 'teacher';

    function indexAction() {

        $um = $this->get('fos_user.user_manager');
        $gm = $this->get('fos_user.group_manager');

        return $this->render('PlanningBundle:User:index.html.twig', array(
            'users'=>$um->findUsers(),
            'groups'=>$gm->findGroups()
        ));
    }

    function addUserAction(Request $request) {
        $um = $this->get('fos_user.user_manager');

        $form = $this->createFormBuilder()
            ->add('firstname', 'text')
            ->add('lastname', 'text')
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('type', 'choice', array(
                'choices' => array(
                    self::TYPE_USER => 'Aucun type spécifique / Administration',
                    self::TYPE_STUDENT => 'Elève',
                    self::TYPE_TUTOR => 'Tuteur',
                    self::TYPE_TEACHER => 'Professeur'),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('Ajouter', 'submit')
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isValid()) {

            $data = $form->getData();

            switch ($data['type']) {

                case self::TYPE_STUDENT:
                    $user = new Student();
                    break;
                case self::TYPE_TEACHER:
                    $user = new Teacher();
                    break;
                case self::TYPE_TUTOR:
                    $user = new Tutor();
                    break;
                case self::TYPE_USER : default :
                    $user = $um->createUser();
                    break;

            }

            /** @var User $user */
            $user->setFirstname($data['firstname']);
            $user->setPassword(uniqid());
            $user->setLastname($data['lastname']);
            $user->setEmail($data['email']);
            $user->setUsername($data['username']);

            $um->updateUser($user);
            return $this->redirectToRoute('user_group_list');
        }


        return $this->render('PlanningBundle:User:add_user.html.twig', array(
            'form' => $form->createView()
        ));

    }

} 