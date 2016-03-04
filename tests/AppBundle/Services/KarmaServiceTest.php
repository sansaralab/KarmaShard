<?php

namespace Tests\AppBundle\Services;

use AppBundle\Interfaces\ActionsServiceInterface;
use AppBundle\DBAL\Types\IdentityTypeType;
use AppBundle\Entity\Action;
use AppBundle\Entity\ActionCategory;
use AppBundle\Interfaces\KarmaServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class KarmaServiceTest extends KernelTestCase
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

    public function testKarmaServiceDefinition()
    {
        $karma = $this->container->get('karma');

        $isTrueInstance = $karma instanceof KarmaServiceInterface;

        $this->assertEquals(true, $isTrueInstance);
    }

    public function testNonexistentPersonKarma()
    {
        $karma = $this->container->get('karma');

        $nonexistentKarma = $karma->getPersonKarma('i_am_nothing@nothis.void', IdentityTypeType::EMAIL);

        $this->assertEquals('i_am_nothing@nothis.void', $nonexistentKarma->personId);
        $this->assertEquals(IdentityTypeType::EMAIL, $nonexistentKarma->personIdType);
        $this->assertEquals(null, $nonexistentKarma->karma);
    }
}
