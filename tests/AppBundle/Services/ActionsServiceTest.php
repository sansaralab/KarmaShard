<?php

namespace Tests\AppBundle\Services;

use AppBundle\Contracts\ActionsServiceContract;
use AppBundle\DBAL\Types\IdentityTypeType;
use AppBundle\Entity\Action;
use AppBundle\Entity\ActionCategory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ActionsServiceTest extends KernelTestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->container = static::$kernel->getContainer();
    }

    /**
     * Testing that actions service in container is instanceof ActionsServiceContract
     */
    public function testActionsServiceDefinition()
    {
        $actions = $this->container->get('actions');

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
        $em = $this->container->get('doctrine.orm.entity_manager');
        $actions = $this->container->get('actions');
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
