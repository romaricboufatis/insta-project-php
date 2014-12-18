<?php

namespace Insta\PlanningBundle\Tests\Controller;

use Insta\PlanningBundle\Entity\Room;
use Insta\PlanningBundle\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LocationControllerTest extends WebTestCase
{
    /** @var Client */
    private $client = null;

    public static function setUpBeforeClass() {
        static::bootKernel();
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $room = $em->getRepository('PlanningBundle:Room')->findOneBy(array('name'=>'Test Room'));
        $site = $em->getRepository('PlanningBundle:Site')->findOneBy(array('name'=>'Test Site'));

        if (is_null($site)) {
            $site = new Site();
            $site->setName('Test Site')
                ->setCity('Paris')
                ->setStreet('36 quai des orfèvres')
                ->setZipCode(75000)
                ->setPhoneNumber('+33000000000')
                ->setSubwayStop('INVALIDES');

            $em->persist( $site );
            $em->flush();
        }

        if (is_null($room)) {
            $room = new Room();
            $room->setName('Test Room')
                ->setFreeComputer(5)
                ->setSite($site);
            $em->persist($room);
            $em->flush();
        }
    }

    public function setUp()
    {
        $this->client = static::createClient();
        $this->logIn();
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'main';
        $token = new UsernamePasswordToken('admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    public function testIndex()
    {

        $crawler = $this->client->request('GET', '/admin/location/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Sites")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Salles")')->count());
    }

    public function testSitelist()
    {
        

        $crawler = $this->client->request('GET', '/admin/location/sites');

        $this->assertGreaterThan(0, $crawler->filter('th:contains("#")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Nom")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Adresse")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Téléphone")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Ligne de métro")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Nombre de salles")')->count());
    }

    public function testRoomlist()
    {

        $crawler = $this->client->request('GET', '/admin/location/rooms');

        $this->assertGreaterThan(0, $crawler->filter('th:contains("#")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Nom")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Adresse")')->count());
        $this->assertGreaterThan(0, $crawler->filter('th:contains("Site")')->count());
    }

    /**
     * @dataProvider provideSites
     * @param $site_id
     * @param $valid
     */
    public function testSite( $site_id, $valid )
    {

        $crawler = $this->client->request('GET', '/admin/location/site-' . $site_id);

        if ($valid) {
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Nom")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Adresse postale")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Numéro de téléphone")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Métro")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Salles")')->count());
            $this->assertGreaterThan(0, $crawler->filter('iframe')->count());
        } else {
            $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        }


    }

    /**
     * @dataProvider provideRooms
     * @param $room_id
     * @param $valid
     */
    public function testRoom($room_id , $valid)
    {
        $crawler = $this->client->request('GET', '/admin/location/room-'.$room_id);

        if ($valid) {
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Nom")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Site")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Numéro de téléphone")')->count());
        } else {
            $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        }

    }

    /**
     * @dataProvider provideSiteForm
     * @param $data
     * @param $valid
     */
    public function testAddsite($data, $valid)
    {


        $crawler = $this->client->request('GET', '/admin/location/site/new');
        $this->assertGreaterThan(0, $crawler->filter('form')->count());

        $buttonCrawlerNode = $crawler->selectButton('form_add');
        $form = $buttonCrawlerNode->form($data);
        $crawler = $this->client->submit($form);
        if ($valid) {
            $crawler = $this->client->followRedirect();
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode() );
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Nom")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Adresse postale")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Numéro de téléphone")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Métro")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Salles")')->count());
            $this->assertGreaterThan(0, $crawler->filter('iframe')->count());
        } else {
            $this->assertGreaterThan(0, $crawler->filter('form')->count());
        }
    }

    /**
     * @dataProvider provideRoomForm
     * @param $data
     * @param $valid
     */
    public function testAddroom($data, $valid)
    {
        $crawler = $this->client->request('GET', '/admin/location/room/new');
        $this->assertGreaterThan(0, $crawler->filter('form')->count());

        $buttonCrawlerNode = $crawler->selectButton('form_add');
        $form = $buttonCrawlerNode->form($data);
        $crawler = $this->client->submit($form);
        if ($valid) {
            $crawler = $this->client->followRedirect();
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode() );
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Nom")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Site")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Numéro de téléphone")')->count());
        } else {
            $this->assertGreaterThan(0, $crawler->filter('form')->count());
        }
    }

    /**
     * @dataProvider provideRoomFormWithParam
     * @param $data
     * @param $site_id
     * @param $valid
     */
    public function testAddroomWithParam($data, $site_id, $valid)
    {
        $crawler = $this->client->request('GET', '/admin/location/room/new?site='.$site_id);
        $this->assertGreaterThan(0, $crawler->filter('form')->count());

        $buttonCrawlerNode = $crawler->selectButton('form_add');
        $form = $buttonCrawlerNode->form($data);
        $crawler = $this->client->submit($form);
        if ($valid) {
            $crawler = $this->client->followRedirect();
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode() );
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Nom")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Site")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Numéro de téléphone")')->count());
        } else {
            $this->assertGreaterThan(0, $crawler->filter('form')->count());
        }
    }

    /**
     * @dataProvider provideSiteEditForm
     * @param $site_id
     * @param $site
     * @param $valid
     */
    public function testEditsite($site_id, $site, $valid)
    {
        if (!$valid ) {
            $this->setExpectedException('NotFoundHttpException');
        }

        $crawler = $this->client->request('GET', '/admin/location/site-'.$site_id.'/edit');

        if ($valid) {
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
            $this->assertGreaterThan(0, $crawler->filter('form')->count());
            $buttonCrawlerNode = $crawler->selectButton('form_edit');
            $form = $buttonCrawlerNode->form();
            /** @var Site $site */
            $this->assertEquals($site->getName(), $form->get('form[name]')->getValue());
            $this->assertEquals($site->getCity(), $form->get('form[city]')->getValue());
            $this->assertEquals($site->getStreet(), $form->get('form[street]')->getValue());
            $this->assertEquals($site->getZipCode(), $form->get('form[zipCode]')->getValue());
            $this->assertEquals($site->getSubwayStop(), $form->get('form[subwayStop]')->getValue());
            $this->client->submit($form, array(
                'form[name]' => 'Test Site Edit',
                'form[street]' => '49 - 51 Avenue des Champs-Élysées'

            ));
            $crawler = $this->client->followRedirect();
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode() );
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Nom")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Adresse postale")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Numéro de téléphone")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Métro")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Salles")')->count());

        }
    }


    /**
     * @dataProvider provideRoomEditForm
     * @param $room_id
     * @param $site
     * @param $room
     * @param $valid
     */
    public function testEditroom($room_id, $site, $room, $valid)
    {
        if (!$valid ) {
            $this->setExpectedException('NotFoundHttpException');
        }

        $crawler = $this->client->request('GET', '/admin/location/room-'.$room_id.'/edit');
        if ($valid) {
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
            $this->assertGreaterThan(0, $crawler->filter('form')->count());
            $buttonCrawlerNode = $crawler->selectButton('form_edit');
            $form = $buttonCrawlerNode->form();
            /** @var Room $room */
            $this->assertEquals($room->getName(), $form->get('form[name]')->getValue());
            $this->assertEquals($room->getSite()->getId(), $form->get('form[site]')->getValue());
            /** @var Site $site */
            $this->client->submit($form, array(
                'form[name]' => 'Test Room Edit',
                'form[site]' => $site->getId()
            ));
            $crawler = $this->client->followRedirect();
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode() );
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Nom")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Site")')->count());
            $this->assertGreaterThan(0, $crawler->filter('dt:contains("Numéro de téléphone")')->count());


        }
    }

    public function provideSites() {
        static::setUpBeforeClass();
        $this->bootKernel();

        $sitesArr = array(
            array(0     , false),
            array(null  , false),
            array("d"   , false),
        );
        $sites = self::$kernel->getContainer()->get('doctrine')->getRepository('PlanningBundle:Site')->findAll();
        foreach ($sites as $site) {
            $sitesArr[] = array($site->getId(), true);
        }

        return $sitesArr;

    }

    public function provideRooms() {
        static::setUpBeforeClass();
        $this->bootKernel();

        $sitesArr = array(
            array(0     , false),
            array(null  , false),
            array("d"   , false),
        );
        $rooms = self::$kernel->getContainer()->get('doctrine')->getRepository('PlanningBundle:Room')->findAll();
        foreach ($rooms as $room) {
            $sitesArr[] = array($room->getId(), true);
        }

        return $sitesArr;

    }

    public function provideSiteForm() {

        return array(
            array(array(
                'form[name]'=>'Test Site',
                'form[street]'=>'1 Avenue des Champs Elysées',
                'form[zipCode]'=>'75001',
                'form[city]'=>'Paris',
                'form[phoneNumber]'=>'+33100000000',
                'form[subwayLines]'=>'A',
                'form[subwayStop]'=>'Franklin D. Roosevelt',
            ), true),
            array(array(), false), // Tout est à null
//            array(array(
//                'form[name]'=>'',
//                'form[street]'=> '',
//                'form[zipCode]'=>'',
//                'form[city]'=>'',
//                'form[phoneNumber]'=>'',
//                'form[subwayLines]'=>'A,B,4',
//                'form[subwayStop]'=>'',
//            ), false),
        );

    }

    public function provideRoomForm() {
        static::setUpBeforeClass();
        $this->bootKernel();
        $room = self::$kernel->getContainer()->get('doctrine')->getRepository('PlanningBundle:Site')->findOneBy(array('name'=>'Test Site'));

        return array(
            array(array(
                'form[name]'=>'Test Room',
                'form[site]'=> $room->getId(),
                'form[freeComputer]'=>5,
            ), true),
            array(array(), false), // Tout est à null
//            array(array(
//                'form[name]'=>'',
//                'form[site]'=>$room->getId(),
//                'form[freeComputer]'=> '',
//            ), false),
        );

    }

    public function provideRoomFormWithParam() {
        static::setUpBeforeClass();
        $this->bootKernel();
        $room = self::$kernel->getContainer()->get('doctrine')->getRepository('PlanningBundle:Site')->findOneBy(array('name'=>'Test Site'));

        return array(
            array(array(
                'form[name]'=>'Test Room',
                'form[freeComputer]'=>5,
            ), $room->getId(), true),
            array(array(), null, false), // Tout est à null
//            array(array(
//                'form[name]'=>'',
//                'form[freeComputer]'=>'',
//            ), $room->getId(), false),
        );

    }

    public function provideSiteEditForm() {
        static::setUpBeforeClass();
        $this->bootKernel();
        $room = self::$kernel->getContainer()->get('doctrine')->getRepository('PlanningBundle:Site')->findOneBy(array('name'=>'Test Site'));

        return array(
            array($room->getId(), $room, true),
//            array('d',null, false),
        );

    }

    public function provideRoomEditForm() {
        static::setUpBeforeClass();
        $this->bootKernel();
        $room = self::$kernel->getContainer()->get('doctrine')->getRepository('PlanningBundle:Room')->findOneBy(array('name'=>'Test Room'));
        $site = self::$kernel->getContainer()->get('doctrine')->getRepository('PlanningBundle:Site')->findOneBy(array('name'=>'Test Site'));

        return array(
            array($room->getId(),   $site,  $room,  true),
        );

    }

}
