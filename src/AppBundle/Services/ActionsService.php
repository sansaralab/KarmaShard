<?php

namespace AppBundle\Services;

use AppBundle\Interfaces\ActionsServiceInterface;
use AppBundle\DBAL\Types\IdentityTypeType;
use AppBundle\Entity\Action;
use AppBundle\Entity\ActionCategory;
use Doctrine\ORM\EntityManager;

class ActionsService implements ActionsServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function postAction(
        string $personId,
        string $identityType,
        ActionCategory $actionCategory,
        $value,
        $sender,
        $comment = null
    ) : bool
    {
        try {
            $action = new Action();

            $action->setPersonId($personId);
            $action->setIdentityType($identityType);
            $action->setValue($value);
            $action->setSender($sender);
            $action->setComment($comment);
            $action->setCategory($actionCategory);
            $action->setDate(new \DateTime());

            $this->em->persist($action);
            $this->em->flush();
        } catch (\Exception $ex) {
            // TODO: log error
            throw $ex;

            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getPersonsActions(string $identityType, string $personId) : array
    {
        $repo = $this->em->getRepository('AppBundle:Action');

        $result = $repo->findBy([
            'identityType' => $identityType,
            'personId' => $personId
        ]);

        return $result;
    }
}
