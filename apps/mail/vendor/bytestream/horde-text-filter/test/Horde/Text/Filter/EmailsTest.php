<?php
/**
 * Horde_Text_Filter_Emails tests.
 *
 * @author     Michael Slusarz <slusarz@horde.org>
 * @category   Horde
 * @license    http://www.horde.org/licenses/lgpl21 LGPL 2.1
 * @package    Text_Filter
 * @subpackage UnitTests
 */

class Horde_Text_Filter_EmailsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider emailsProvider
     */
    public function testEmails($input, $expected)
    {
        $this->assertEquals(
            $expected,
            Horde_Text_Filter::filter($input, 'emails', array(
                'class' => 'pagelink'
            ))
        );
    }

    public function emailsProvider()
    {
        return array(
            array(
                'Inline address test@example.com test.',
                'Inline address <a class="pagelink" href="mailto:test@example.com">test@example.com</a> test.'
            ),
            array(
                'Inline protocol mailto: test@example.com test with whitespace.',
                'Inline protocol mailto: <a class="pagelink" href="mailto:test@example.com">test@example.com</a> test with whitespace.'
            ),
            array(
                'Inline Outlook [mailto:test@example.com] test.',
                'Inline Outlook [mailto:<a class="pagelink" href="mailto:test@example.com">test@example.com</a>] test.'
            ),
            array(
                'Inline angle brackets <test@example.com> test.',
                'Inline angle brackets <<a class="pagelink" href="mailto:test@example.com">test@example.com</a>> test.'
            ),
            array(
                'Inline angle brackets (HTML) &lt;test@example.com&gt; test.',
                'Inline angle brackets (HTML) &lt;<a class="pagelink" href="mailto:test@example.com">test@example.com</a>&gt; test.'
            ),
            array(
                'Inline angle brackets with mailto &lt;mailto:test@example.com&gt; test.',
                'Inline angle brackets with mailto &lt;mailto:<a class="pagelink" href="mailto:test@example.com">test@example.com</a>&gt; test.'
            ),
            array(
                'Inline with parameters test@example.com?subject=A%20subject&body=The%20message%20body test.',
                'Inline with parameters <a class="pagelink" href="mailto:test@example.com?subject=A%20subject&amp;body=The%20message%20body">test@example.com?subject=A%20subject&amp;body=The%20message%20body</a> test.'
            ),
            array(
                'Inline protocol with parameters mailto:test@example.com?subject=A%20subject&body=The%20message%20body test.',
                'Inline protocol with parameters mailto:<a class="pagelink" href="mailto:test@example.com?subject=A%20subject&amp;body=The%20message%20body">test@example.com?subject=A%20subject&amp;body=The%20message%20body</a> test.'
            ),
            array(
                'test@example.com in front test.',
                '<a class="pagelink" href="mailto:test@example.com">test@example.com</a> in front test.'
            ),
            array(
                'At end test of test@example.com',
                'At end test of <a class="pagelink" href="mailto:test@example.com">test@example.com</a>'
            ),
            array(
                'Don\'t link http://test@www.horde.org/ test.',
                'Don\'t link http://test@www.horde.org/ test.'
            ),
            array(
                'Real world example: mailto:pmx-auto-approve%2b27f0e770e2d85bf9bd8fea61f9dedbff@example.com?subject=Release%20message%20from%20quarantine&body=%5b%23ptn6Pw-1%5d',
                'Real world example: mailto:<a class="pagelink" href="mailto:pmx-auto-approve%2b27f0e770e2d85bf9bd8fea61f9dedbff@example.com?subject=Release%20message%20from%20quarantine&amp;body=%5b%23ptn6Pw-1%5d">pmx-auto-approve%2b27f0e770e2d85bf9bd8fea61f9dedbff@example.com?subject=Release%20message%20from%20quarantine&amp;body=%5b%23ptn6Pw-1%5d</a>'
            )
        );
    }

}
