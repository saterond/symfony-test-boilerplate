<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 *
 * @Route(service="app.controller_default")
 */
class DefaultController extends AbstractBaseController
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
			'articles' => $this->em->getRepository(Article::class)->findAll(),
        ]);
    }
}
