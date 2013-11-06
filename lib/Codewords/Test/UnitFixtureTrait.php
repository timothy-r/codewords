<?php namespace Codewords\Test;

use Codewords\Board;
use Codewords\Cell;
use Codewords\Word;

trait UnitFixtureTrait
{
    protected function addCell(Board $board, $number, $char, $x, $y)
    {
        $c = new Cell($number);
        $c->setCharacter($char);
        $board->addCell($c, $x, $y);
        return $c;
    }
}
