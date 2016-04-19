<?php
namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    /** @var EntityManagerInterface */
    protected $em;

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        /** @var Article $article */
        $article = $this->em->getRepository(Article::class)->findOneBy([]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($article->getTitle(), $crawler->filter('body')->text());
    }

    protected function setUp()
    {
        self::bootKernel();
        $this->em = self::$kernel->getContainer()->get("doctrine.orm.default_entity_manager");
    }
}
