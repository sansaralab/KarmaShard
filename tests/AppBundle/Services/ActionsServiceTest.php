<?php

namespace Tests\AppBundle\Services;

use AppBundle\Contracts\ActionsServiceContract;
use AppBundle\DBAL\Types\IdentityTypeType;
use AppBundle\Entity\Action;
use AppBundle\Entity\ActionCategory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActionsServiceTest extends WebTestCase
{
    public function testActionsServiceDefinition()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $actions = $container->get('actions');

        $isTrueInstance = $actions instanceof ActionsServiceContract;

        $this->assertEquals(true, $isTrueInstance);
    }

    /**
     * Testing creating one Action with ActionCategory for test user.
     * Testing that user has only one Action.
     *
     * @throws \Exception
     */
    public function testPostAction()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $actions = $container->get('actions');
        $actionCategory = new ActionCategory();
        $actionCategory->setName('test_action');
        $actionCategory->setWeight('5');
        $em->persist($actionCategory);
        $em->flush();

        $postResult = $actions->postAction(
            'test_person_id@email.tld',
            IdentityTypeType::EMAIL,
            $actionCategory,
            null,
            'sender_id'
        );

        $this->assertEquals(true, $postResult);

        $allActions = $actions->getPersonsActions(
            IdentityTypeType::EMAIL,
            'test_person_id@email.tld'
        );

        $this->assertEquals(1, count($allActions));
    }
}
