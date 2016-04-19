<?php
namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

abstract class AbstractBaseController
{

	/**
	 * @var FormFactoryInterface
	 */
	protected $formFactory;

	/**
	 * @var TwigEngine
	 */
	protected $templating;

	/**
	 * @var Router
	 */
	protected $router;

	/**
	 * @var EntityManagerInterface
	 */
	protected $em;

	/**
	 * AbstractBaseController constructor.
	 * @param FormFactoryInterface   $formFactory
	 * @param TwigEngine             $templating
	 * @param Router                 $router
	 * @param EntityManagerInterface $em
	 */
	public function __construct(FormFactoryInterface $formFactory, TwigEngine $templating, Router $router, EntityManagerInterface $em)
	{
		$this->formFactory = $formFactory;
		$this->templating = $templating;
		$this->router = $router;
		$this->em = $em;
	}

	/**
	 * Create form
	 *
	 * @param string $type
	 * @param mixed  $data
	 * @param array  $options
	 * @return FormInterface
	 */
	protected function createForm($type = 'Symfony\Component\Form\Extension\Core\Type\FormType', $data = null, array $options = [])
	{
		return $this->formFactory->create($type, $data, $options);
	}

	/**
	 * Create redirect response
	 *
	 * @param string $route
	 * @param array  $params
	 * @param int    $referenceType
	 * @param int    $code
	 * @return RedirectResponse
	 */
	protected function redirect($route, $params = [], $referenceType = RouterInterface::ABSOLUTE_PATH, $code = 302)
	{
		return new RedirectResponse($this->router->generate($route, $params, $referenceType), $code);
	}

	/**
	 * Render controller response
	 *
	 * @param string        $view
	 * @param array         $parameters
	 * @param Response|null $response
	 * @return Response
	 */
	protected function render($view, array $parameters = [], Response $response = null)
	{
		return $this->templating->renderResponse($view, $parameters, $response);
	}
}
