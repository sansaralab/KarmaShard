<?php

namespace AppBundle\Services;

use AppBundle\Interfaces\ActionsServiceInterface;
use AppBundle\Interfaces\KarmaServiceInterface;
use Doctrine\ORM\EntityManager;
use Domain\Person\PersonSummary;

class KarmaService implements KarmaServiceInterface
{
    /**
     * @var ActionsServiceInterface
     */
    protected $actionsService;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(ActionsServiceInterface $actionsService, EntityManager $em)
    {
        $this->actionsService = $actionsService;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function getPersonKarma($personId, $personIdType) : PersonSummary
    {
        $summary = new PersonSummary();

        $summary->karma = $this->calculateKarma($personId, $personIdType);
        $summary->personId = $personId;
        $summary->personIdType = $personIdType;

        return $summary;
    }

    /**
     * Calculates karma based on avg categories weight
     * except categories with zero weight.
     *
     * @param $personId
     * @param $personIdType
     *
     * @return float
     */
    protected function calculateKarma($personId, $personIdType) : float
    {
        try {
            $result = $this->em->createQueryBuilder()
                ->select('AVG(category.weight) as karma')
                ->from('AppBundle:Action', 'action')
                ->join('action.category', 'category')
                ->where('category.weight <> 0')
                ->andWhere('action.personId = :personid')
                ->andWhere('action.identityType = :identitytype')
                ->setParameters([
                    'personid' => $personId,
                    'identitytype' => $personIdType
                ])
                ->getQuery()
                ->getSingleResult();
        } catch (\Exception $ex) {
            $result = ['karma' => 0];
        }

        return $result['karma'] ?? 0;
    }
}
