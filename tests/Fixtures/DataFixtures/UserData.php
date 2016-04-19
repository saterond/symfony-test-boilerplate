<?php
namespace Fixtures\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fixtures\FixturesConstants;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{

	/** @var ContainerInterface */
	protected $container;

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
	{
		$email = FixturesConstants::USER_EMAIL;
		$password = FixturesConstants::USER_PASSWORD;

		$user = (new User())
			->setDatetimeCreated(new \DateTime())
			->setActive(true)
			->setRole("ROLE_USER")
			->setEmail($email);

		$user->setPassword(
			$this->container->get("security.encoder_factory")
				->getEncoder($user)
				->encodePassword($password, null)
		);

		$manager->persist($user);
		$manager->flush();
	}

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}
}
