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

    /**
     * {@inheritdoc}
     */
    public function getAvailableCategories() : array
    {
        $categories = $this->em->getRepository('AppBundle:ActionCategory')->findAll();

        return $categories;
    }

    /**
     * {@inheritdoc}
     */
    public function createCategory(string $name, int $weight) : ActionCategory
    {
        $category = new ActionCategory();
        $category->setName($name);
        $category->setWeight($weight);

        try {
            $this->em->persist($category);
            $this->em->flush();
        } catch (\Exception $ex) {
            // TODO: Log error

            return null;
        }

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCategory(string $name) : bool
    {
        /*
         * Yes, 2 queries, but this is simple.
         */
        $category = $this->em->getRepository('AppBundle:ActionCategory')
            ->findOneBy(['name' => $name]);

        /*
         * If there is no category than we also got a point
         */
        if (is_null($category)) {
            return true;
        }

        try {
            $this->em->remove($category);
            $this->em->flush();
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllCategories() : array
    {
        return $this->em->getRepository('AppBundle:ActionCategory')->findAll();
    }
}
