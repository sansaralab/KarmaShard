<?php

namespace AppBundle\Interfaces;

use Domain\Person\PersonSummary;

interface KarmaServiceInterface
{
    /**
     * Calculates and returns given person summary
     *
     * @param string $personId
     * @param string $personIdType
     *
     * @return PersonSummary
     */
    public function getPersonKarma($personId, $personIdType) : PersonSummary;
}