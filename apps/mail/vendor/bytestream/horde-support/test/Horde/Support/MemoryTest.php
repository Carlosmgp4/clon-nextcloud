<?php
/**
 * Copyright 2011-2017 Horde LLC (http://www.horde.org/)
 *
 * @category   Horde
 * @package    Support
 * @subpackage UnitTests
 * @license    http://www.horde.org/licenses/bsd
 */

/**
 * @category   Horde
 * @package    Support
 * @subpackage UnitTests
 * @license    http://www.horde.org/licenses/bsd
 */
class Horde_Support_MemoryTest extends \PHPUnit\Framework\TestCase
{
    public function testMemoryStart()
    {
        $t = new Horde_Support_Memory;
        $this->assertIsArray($t->push());
    }

    public function testMemoryEnd()
    {
        $t = new Horde_Support_Memory;
        $t->push();
        $this->assertIsArray($t->pop());
    }

    public function testStartValues()
    {
        $t = new Horde_Support_Memory;
        $this->assertEquals(4, count($t->push()));
    }

    public function testEndValues()
    {
        $t = new Horde_Support_Memory;
        $t->push();
        $this->assertEquals(4, count($t->pop()));
    }

    public function testOnlyIncrease()
    {
        $t = new Horde_Support_Memory;
        $t->push();
        $end = $t->pop();
        $this->assertTrue($end[1] >= 0);
        $this->assertTrue($end[3] >= 0);
    }

    public function testNotPushedThrowsException()
    {
        $t = new Horde_Support_Memory();
        try {
            $t->pop();
            $this->fail('Expected Exception');
        } catch (Exception $e) {}
    }

}
