<?php

namespace Tests\AppBundle\Services;

use AppBundle\Interfaces\ActionsServiceInterface;
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
     * Testing that actions service in container is instanceof ActionsServiceInterface
     */
    public function testActionsServiceDefinition()
    {
        $actions = $this->container->get('actions');

        $isTrueInstance = $actions instanceof ActionsServiceInterface;

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
        $actions = $this->container->get('actions');
        $actionCategory = $actions->createCategory('test_category', 5);

        $this->assertNotNull($actionCategory);
        $this->assertEquals('test_category', $actionCategory->getName());
        $this->assertEquals(5, $actionCategory->getWeight());

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

    public function testDeleteCategory()
    {
        $actions = $this->container->get('actions');

        $oneCategory = $actions->createCategory('some_category', 1);

        $this->assertNotNull($oneCategory);

        $deletionResult = $actions->deleteCategory('some_category');

        $this->assertEquals(true, $deletionResult);

        $twoCategory = $actions->createCategory('another_category', 1);

        $this->assertNotNull($twoCategory);

        $someActionResult = $actions->postAction(
            'some_person@email.tld',
            IdentityTypeType::EMAIL,
            $twoCategory,
            null,
            'some_sender'
        );

        $this->assertEquals(true, $someActionResult);

        $cantDelete = $actions->deleteCategory('another_category');

        $this->assertEquals(false, $cantDelete);
    }
}
