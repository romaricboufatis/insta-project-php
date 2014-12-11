<?php

namespace Insta\PlanningBundle\Controller;

use Insta\PlanningBundle\Entity\Room;
use Insta\PlanningBundle\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LocationController extends Controller
{
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();

        $sites = $em->getRepository('PlanningBundle:Site')->findAll();
        $rooms = $em->getRepository('PlanningBundle:Room')->findAll();


        return $this->render('PlanningBundle:Location:_index.html.twig', array(
                'sites' => $sites,
                'rooms' => $rooms,
            ));    }

    public function siteListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sites = $em -> getRepository('PlanningBundle:Site')->findAll();
        return $this->render('PlanningBundle:Location:site_list.html.twig', array(
                'sites' => $sites
            ));
    }

    public function roomListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rooms = $em->getRepository('PlanningBundle:Room')->findAll();

        return $this->render('PlanningBundle:Location:room_list.html.twig', array(
                'rooms' => $rooms,
            ));    }

    public function siteAction(Site $id)
    {
        return $this->render('PlanningBundle:Location:site_show.html.twig', array(
                'site'=> $id
            ));    }

    public function roomAction(Room $id)
    {
        return $this->render('PlanningBundle:Location:room_show.html.twig', array(
                'room'=>$id
            ));    }

    public function addSiteAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $newSite = new Site();
        $form = $this->createFormBuilder($newSite)
            ->add('name', 'text',array('label' => "location.name"))
            ->add('street', 'text',array('label' => "location.street"))
            ->add('zipCode', 'integer',array('label' => "location.zipCode"))
            ->add('city', 'text',array('label' => "location.city"))
            ->add('phoneNumber', 'text', array('max_length'=>12,'label' => "location.phoneNumber"))
            ->add('subwayStop', 'text',array('label' => "location.subwayStop"))
            ->add('subwayLines', 'text',array('label' => "location.subwayLines"))
            ->add('add', 'submit',array('label' => "form.add"))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $subwayLines = array_map('trim', array_filter( explode(',', $newSite->getSubwayLines())));

            $subwayLinesWithUrl = array();

            foreach( $subwayLines as $line )  {
                $subwayLinesWithUrl[$line] = 'http://www.ratp.fr/fr/upload/docs/image/png/2014-02/footer-ligne'.strtolower($line).'.png';
            }


            $newSite->setSubwayLines($subwayLinesWithUrl);

            $em->persist($newSite);
            $em->flush();
            return $this->redirectToRoute('site', array('id'=>$newSite->getId()));

        }

        return $this->render('PlanningBundle:Location:site_add.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function deleteSiteAction(Site $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em -> remove($id);
        $em -> flush();
        return $this->redirectToRoute('site_list');
    }

    public function addRoomAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $newRoom = new Room();
        $site = null;
        if(!is_null($request->get('site'))) {
            $site = $this->getDoctrine()->getRepository('PlanningBundle:Site')->find($request->get('site'));
            $newRoom->setSite($site);
        }
        $form = $this->createFormBuilder($newRoom)
            ->add('name', 'text',array('label' => 'room.name'))
            ->add('site', 'entity', array(
                'label' => 'room.site',
                'class' => 'Insta\PlanningBundle\Entity\Site',
                'property' => 'name',
                'disabled' => (is_null($site)) ? false : true
            ))
            ->add('freeComputer', 'number',array('label' => "room.freeComputer"))
            ->add('add', 'submit',array('label' => "form.add"))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($newRoom);
            $em->flush();
            return $this->redirectToRoute('room', array('id'=>$newRoom->getId()));

        }

        return $this->render('PlanningBundle:Location:room_add.html.twig', array(
                'form' => $form->createView()
            ));    }

    public function editSiteAction(Request $request, Site $id)
    {
        $id->setSubwayLines( implode(',', array_keys($id->getSubwayLines())) );
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($id)
            ->add('name', 'text',array('label' => "location.name"))
            ->add('street', 'text',array('label' => "location.street"))
            ->add('zipCode', 'integer',array('label' => "location.zipCode"))
            ->add('city', 'text',array('label' => "location.city"))
            ->add('phoneNumber', 'text', array('max_length'=>12,'label' => "location.phoneNumber"))
            ->add('subwayStop', 'text',array('label' => "location.subwayStop"))
            ->add('subwayLines', 'text',array('label' => "location.subwayLines"))
            ->add('edit', 'submit',array('label' => "form.edit"))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $subwayLines = array_map('trim', array_filter( explode(',', $id->getSubwayLines())));

            $subwayLinesWithUrl = array();

            foreach( $subwayLines as $line )  {
                $subwayLinesWithUrl[$line] = 'http://www.ratp.fr/fr/upload/docs/image/png/2014-02/footer-ligne'.strtolower($line).'.png';
            }


            $id->setSubwayLines($subwayLinesWithUrl);

            $em->flush();
            return $this->redirectToRoute('site', array('id'=>$id->getId()));

        }


        return $this->render('PlanningBundle:Location:site_edit.html.twig', array(
                'form'=>$form->createView(),
                'site'=>$id
            ));    }

    public function editRoomAction(Request $request, Room $id)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder($id)

            ->add('name', 'text',array('label' => "room.name"))
            ->add('site', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Site',
                'property' => 'name',
                'label' => "room.site"
            ))
            ->add('edit', 'submit',array('label' => "form.edit"))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('room', array('id'=>$id->getId()));
        }

        return $this->render('PlanningBundle:Location:room_edit.html.twig', array(
                'form'=>$form->createView(),
                'room'=>$id
            ));    }

    public function deleteRoomAction(Room $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        return $this->redirectToRoute('room_list');

    }
}
