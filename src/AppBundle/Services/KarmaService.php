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
     * @param Action[] $actions
     * @return PersonSummary
     */
    protected function calculateKarma(array $actions) : PersonSummary
    {
        // crap here...

        $summary = new PersonSummary();
        $positives = 0;
        $negatives = 0;

        foreach ($actions as $action) {
            $weight = $action->getCategory()->getWeight();

            if ($weight > 0) {
                $positives += $weight;
            } elseif ($weight < 0) {
                $negatives += $weight;
            }
        }

        if ($negatives < 0) {
            $negatives *= -1;
        }

        $max = max($positives, $negatives);
        $min = min($positives, $negatives);

        $maxPart = 10 / $max;
        $minPart = $min * $maxPart;

        if ($max === $positives) {
            $result = 10 - $minPart;
        } else {
            $result = -10 + $minPart;
        }

        $summary->karma = $result;

        return $summary;
    }
}
