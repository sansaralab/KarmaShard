<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoriesController extends Controller
{
    /**
     * @Route("/categories")
     */
    public function indexAction()
    {
        $categories = $this->get('actions')->getAllCategories();
        
        return $this->render('AdminBundle:Categories:index.html.twig', [
            'categories' => $categories
        ]);
    }

}
