<?php

namespace AppBundle\Interfaces;

use AppBundle\Entity\ActionCategory;

interface ActionsServiceInterface
{
    /**
     * @param string $personId
     * @param string $identityType
     * @param ActionCategory $actionCategory
     * @param string|null $value
     * @param $sender
     * @param string $comment
     *
     * @return bool
     */
    public function postAction(
        string $personId,
        string $identityType,
        ActionCategory $actionCategory,
        $value,
        $sender,
        $comment = null
    ) : bool;

    /**
     * @param string $identityType
     * @param string $personId
     *
     * @return array
     */
    public function getPersonsActions(string $identityType, string $personId) : array;
}
