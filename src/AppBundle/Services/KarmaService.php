<?php

namespace AppBundle\Services;

use AppBundle\Entity\Action;
use AppBundle\Interfaces\ActionsServiceInterface;
use AppBundle\Interfaces\KarmaServiceInterface;
use Domain\Person\PersonSummary;

class KarmaService implements KarmaServiceInterface
{
    /**
     * @var ActionsServiceInterface
     */
    protected $actionsService;

    public function __construct(ActionsServiceInterface $actionsService)
    {
        $this->actionsService = $actionsService;
    }

    /**
     * {@inheritdoc}
     */
    public function getPersonKarma($personId, $personIdType) : PersonSummary
    {
        $allActions = $this->actionsService->getPersonsActions($personIdType, $personId);

        if (0 === count($allActions)) {
            $summary = new PersonSummary();
            $summary->karma = null;
        } else {
            $summary = $this->calculateKarma($allActions);
        }

        $summary->personId = $personId;
        $summary->personIdType = $personIdType;

        return $summary;
    }

    /**
     * TODO: Implement me!
     *
     * @param Action[] $actions
     * @return PersonSummary
     */
    protected function calculateKarma(array $actions) : PersonSummary
    {
        $summary = new PersonSummary();
        $summary->karma = 5;

        return $summary;
    }
}
