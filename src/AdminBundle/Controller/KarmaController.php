<?php

namespace AdminBundle\Controller;

use AppBundle\DBAL\Types\IdentityTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class KarmaController extends Controller
{
    /**
     * @Route("/karma")
     */
    public function indexAction(Request $request)
    {
        // TODO: cahnge it to get all of the variants from database
        $identityTypes = IdentityTypeType::getChoices();
        $query = $request->query->get('query', '');
        $selectedIdentityType = $request->query->get('identity_type', '');
        $result = null;
        
        return $this->render('AdminBundle:Karma:index.html.twig', array(
            'query' => $query,
            'identity_types' => $identityTypes,
            'selected_identity_type' => $selectedIdentityType,
            'result' => $result
        ));
    }

}
