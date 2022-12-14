<?php
/**
 * Copyright 2013-2017 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (LGPL). If you
 * did not receive this file, see http://www.horde.org/licenses/lgpl21.
 *
 * @category   Horde
 * @copyright  2013 Horde LLC
 * @license    http://www.horde.org/licenses/lgpl21 LGPL 2.1
 * @package    Smtp
 * @subpackage UnitTests
 */

/**
 * Tests for the mailbox object.
 *
 * @author     Michael Slusarz <slusarz@horde.org>
 * @category   Horde
 * @copyright  2013 Horde LLC
 * @ignore
 * @license    http://www.horde.org/licenses/lgpl21 LGPL 2.1
 * @package    Smtp
 * @subpackage UnitTests
 */
class Horde_Smtp_Xoauth2Test extends \PHPUnit\Framework\TestCase
{

    public function testTokenGeneration()
    {
        // Example from https://developers.google.com/gmail/xoauth2_protocol
        $xoauth2 = new Horde_Smtp_Password_Xoauth2(
            'someuser@example.com',
            'vF9dft4qmTc2Nvb3RlckBhdHRhdmlzdGEuY29tCg=='
        );

        $this->assertEquals(
            'dXNlcj1zb21ldXNlckBleGFtcGxlLmNvbQFhdXRoPUJlYXJlciB2RjlkZnQ0cW1UYzJOdmIzUmxja0JoZEhSaGRtbHpkR0V1WTI5dENnPT0BAQ==',
            $xoauth2->getPassword()
        );
    }

}
