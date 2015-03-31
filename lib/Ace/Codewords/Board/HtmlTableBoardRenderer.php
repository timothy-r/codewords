<?php namespace Codewords\Board;

use Codewords\BoardRendererInterface;
use Codewords\Board\Board;

/**
* Produces a HTML table version of a Board
*/
class HtmlTableBoardRenderer implements BoardRendererInterface
{
    public function render(Board $board)
    {
        $result = '<table style="border-color: #000; border-width: 1px;">' . "\n";

        $length = $board->getLength();
        for ($y = 0; $y < $length; $y++){
            $result .= '<tr>';
            for ($x = 0; $x < $length; $x++) {
                $cell = $board->getCell($x, $y);
                if ($cell->isNull()){
                    $result .= '<td style="background-color:#000"></td>';
                } else if ($character = $cell->getCharacter()){
                    $result .= sprintf('<td>%s</td>', $character);
                } else {
                    $result .= sprintf('<td>%s</td>', $cell->getNumber());
                }
            }
            $result .= "</tr>\n";
        }
        $result .= "</table>\n";
        return $result;
    }
}

