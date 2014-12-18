<?php
/**
 * Created by PhpStorm.
 * User: Rodolphe
 * Date: 18/12/2014
 * Time: 11:42
 */

namespace Insta\PlanningBundle\Tests\Controller;

use Insta\PlanningBundle\Entity\Room;
use Insta\PlanningBundle\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ScheduleControllerTest extends WebTestCase {

    /** @var Client */
    private $client = null;

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

    public function createLessonActionTest()
    {

        $crawler = $this->client->request('GET', '/manage/schedule/lesson/new');
    }

    public function createOralActionTest() {
        $crawler = $this->client->request('GET', '/manage/schedule/oral/new');
    }


}
