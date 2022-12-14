<?php
/**
 * Copyright 2010-2017 Horde LLC (http://www.horde.org/)
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
class Horde_Support_RandomidTest extends \PHPUnit\Framework\TestCase
{
    public function testLength()
    {
        $this->assertEquals(23, strlen(new Horde_Support_Randomid()));
    }

    public function testDuplicates()
    {
        $values = array();

        for ($i = 0; $i < 10000; ++$i) {
            $id = strval(new Horde_Support_Randomid());
            $this->assertArrayNotHasKey($id, $values);
            $values[$id] = 1;
        }
    }
}
