<?php

namespace AdminBundle\Controller;

use AppBundle\DBAL\Types\IdentityTypeType;
use Domain\Person\PersonSummary;
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
        // TODO: make form instead of having raw request access
        // TODO: cahnge it to get all of the variants from database
        $identityTypes = IdentityTypeType::getChoices();
        $query = $request->query->get('query', '');
        $selectedIdentityType = $request->query->get('identity_type', IdentityTypeType::EMAIL);

        /**
         * @var PersonSummary
         */
        $result = null;

        if ($query) {
            $karma = $this->get('karma');
            $result = $karma->getPersonKarma($query, $selectedIdentityType);
        }
        
        return $this->render('AdminBundle:Karma:index.html.twig', array(
            'query' => $query,
            'identity_types' => $identityTypes,
            'selected_identity_type' => $selectedIdentityType,
            'result' => $result
        ));
    }

}
