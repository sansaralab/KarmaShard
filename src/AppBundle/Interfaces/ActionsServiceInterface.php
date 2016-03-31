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

    /**
     * @return ActionCategory[]
     */
    public function getAvailableCategories() : array;

    /**
     * Creates and returns new ActionCategory
     *
     * @param string $name
     * @param int $weight
     *
     * @return ActionCategory|null
     */
    public function createCategory(string $name, int $weight) : ActionCategory;

    /**
     * Deletes category.
     * Returns true on successful deletion.
     * Returns false if category has more than 0 actions.
     *
     * @param string $name
     * @return bool
     */
    public function deleteCategory(string $name) : bool;

    /**
     * Returns all categories
     *
     * @return ActionCategory[]
     */
    public function getAllCategories() : array;
}
