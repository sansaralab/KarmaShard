<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class APIController extends Controller
{
    /**
     * @Route("/api")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:API:index.html.twig', array(
            // ...
        ));
    }

}
