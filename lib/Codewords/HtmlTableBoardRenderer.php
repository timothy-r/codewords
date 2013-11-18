<?php namespace Codewords;

use Codewords\Board\Board;

/**
* Produces a HTML table version of a Board
*/
class HtmlTableBoardRenderer implements IBoardRenderer
{
    public function render(Board $board)
    {
        $result = "<table>\n";

        $length = $board->getLength();
        for ($y = 0; $y < $length; $y++){
            $result .= '<tr>';
            for ($x = 0; $x < $length; $x++) {
                $cell = $board->getCell($x, $y);
                if ($cell->isNull()){
                    $result .= '<td></td>';
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

