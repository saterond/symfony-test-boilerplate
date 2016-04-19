<?php
namespace AppBundle\Controller;

use Fixtures\FixturesConstants;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecuredControllerTest extends WebTestCase
{

	public function testIndex()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/secured-area', [], [], [
			'PHP_AUTH_USER' => FixturesConstants::USER_EMAIL,
			'PHP_AUTH_PW' => FixturesConstants::USER_PASSWORD,
		]);

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
		$this->assertContains("Secured area", $crawler->filter('h1')->text());
	}
}
