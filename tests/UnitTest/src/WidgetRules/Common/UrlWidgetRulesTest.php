<?php
namespace Marmot\Application\WidgetRules\Common;

use PHPUnit\Framework\TestCase;

use Marmot\Core;

class UrlWidgetRulesTest extends TestCase
{
    private $stub;

    public function setUp()
    {
        $this->stub = new UrlWidgetRules();
        Core::setLastError(ERROR_NOT_DEFINED);
    }

    public function tearDown()
    {
        unset($this->stub);
        Core::setLastError(ERROR_NOT_DEFINED);
    }

    public function testIdValid()
    {
        $result = $this->stub->id(1);
        $this->assertTrue($result);
        $this->assertEquals(ERROR_NOT_DEFINED, Core::getLastError()->getId());
    }

    public function testIdInvalid()
    {
        $result = $this->stub->id(-1);
        $this->assertFalse($result);
        $this->assertEquals(ROUTE_NOT_EXIST, Core::getLastError()->getId());
    }
}
