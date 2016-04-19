<?php
namespace Fixtures\DataFixtures;

use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleData extends AbstractFixture implements FixtureInterface
{

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
	{
		$article = (new Article())
			->setTitle("Testing article")
			->setContents("Lorem ipsum dolor sit amet")
			->setDatetimeCreated(new \DateTime());

		$manager->persist($article);
		$manager->flush();
	}
}
