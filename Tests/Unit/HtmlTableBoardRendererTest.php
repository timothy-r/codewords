<?php

require_once(__DIR__ . '/BaseTest.php');

use Codewords\HtmlTableBoardRenderer;

/**
* @group unit
*/
class HtmlTableBoardRendererTest extends BaseTest
{
    public function getCellFixtures()
    {
        return [
            [2, 12, null, 
"<table>
<tr><td>12</td><td>12</td></tr>
<tr><td>12</td><td>12</td></tr>
</table>
"],
            [2, 12, 'C',
"<table>
<tr><td>C</td><td>C</td></tr>
<tr><td>C</td><td>C</td></tr>
</table>
"],
            [2, 0, null,
"<table>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>
</table>
"],
        ];
    }

    /**
    * @dataProvider getCellFixtures
    */
    public function testRenderAsHtml($length, $number, $character, $expected)
    {
        $cell = $this->getMock('Codewords\Board\Cell', ['getNumber', 'getCharacter', 'isNull'], [], '', false);
        $cell->expects($this->any())
            ->method('getNumber')
            ->will($this->returnValue($number));
        $cell->expects($this->any())
            ->method('getCharacter')
            ->will($this->returnValue($character));
        $cell->expects($this->any())
            ->method('isNull')
            ->will($this->returnValue($number == 0));

        $board = $this->getMock('Codewords\Board\Board', ['getLength', 'getCell'], [], '', false);
        $board->expects($this->any())
            ->method('getLength')
            ->will($this->returnValue($length));
        $board->expects($this->any())
            ->method('getCell')
            ->will($this->returnValue($cell));

        $renderer = new HtmlTableBoardRenderer;
        $result = $renderer->render($board);
        $this->assertSame($expected, $result);
    }
}
