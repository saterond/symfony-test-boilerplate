<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecuredController
 *
 * @Route(service="app.controller_secured")
 */
class SecuredController extends AbstractBaseController
{

	/** @var AuthenticationUtils */
	protected $authenticationUtils;

	/**
	 * @Route("/secured-area", name="secured_area")
	 */
	public function defaultAction()
	{
		return $this->render(':secured:index.html.twig');
	}

	/**
	 * @Route("/secured-area/login", name="login")
	 */
	public function loginAction()
	{
		// get the login error if there is one
		$error = $this->authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $this->authenticationUtils->getLastUsername();

		return $this->render(
			':secured:login.html.twig',
			[
				'last_username' => $lastUsername,
				'error' => $error,
			]
		);
	}

	/**
	 * @Route("/secured-area/login_check", name="login_check")
	 */
	public function loginCheckAction()
	{
		// intentionally empty
	}

	/**
	 * @param AuthenticationUtils $authenticationUtils
	 * @return self
	 */
	public function setAuthenticationUtils($authenticationUtils)
	{
		$this->authenticationUtils = $authenticationUtils;
		return $this;
	}
}
