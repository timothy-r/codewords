<?php namespace Codewords;

use Codewords\Game;
use Codewords\Cell;

/**
* First strategy to solve a Game
*/
class StrategyA
{
    protected $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function nextLetter()
    {
        // find already solved letters
        list($next_cell, $expected_char) = $this->getNextUnsolvedCell();
        if (!$next_cell){
            return null;
        }
        // now guess this char based on standard letter frequencies
        //$expected_char = $this->getCharFromFrequency($index);
        if ($this->testCharacter($next_cell, $expected_char)){
            // solve the character
            $next_cell->setCharacter($expected_char);
            return true;
        } 
    }
 
    protected function testCharacter(Cell $cell, $char)
    {
        // iterate over each Game word
        foreach($this->game->getBoard()->getWords() as $word){
            // create a pattern from Word 
            $pattern = '^';
            $test = false; // only test words that contain our character
            foreach ($word as $word_cell){
                if ($word_cell->matches($cell)){
                    $pattern .= $char;
                    $test = true;
                } else if ($character = $word_cell->getCharacter()){
                    $pattern .= $character;
                } else {
                    $pattern .= '.';
                }
            }
            $pattern .= '$';
            #var_dump($char . ' ' . $pattern);

            if ($test){
                $matches = $this->game->getDictionary()->find($pattern);
                //var_dump($matches);
                if (!count($matches)){
                    // no possible words found - reject this guess
                    return false;
                }
            }
        }
        // all words which contain this char can be solved 
        return true;
    }

    protected function getCharFromFrequency($frequency)
    {
        $data = ['', 'E','T','A','O','I','N','S','H','R','D','L','C','U','M','W','F','G','Y','P','B','V','K','J','X','Q','Z'];
        return $data[$frequency];
    }

    /**
    * @return Codewords\Cell
    */
    protected function getNextUnsolvedCell()
    {
        // from current state of the Game try to find the next missing letter
        $frequencies = $this->game->getBoard()->getFrequencies();
        $cells = $this->game->getCells();

        // sort $frequencies to bring most common to the start of the array
        arsort($frequencies);
        $index = 0;

        $data = ['E','T','A','O','I','N','S','H','R','D','L','C','U','M','W','F','G','Y','P','B','V','K','J','X','Q','Z'];

        foreach($frequencies as $number => $count) {
            // test to see if $number is solved yet
            $cell = $cells->at($number);
            $index++;

            if ($character = $cell->getCharacter()){
                print "Cell $number is $character\n";
                $i = array_search($character, $data);
                if ($i !== false) {
                    unset($data[$i]);
                }
            } else {
                print "Solving Cell $number at index $index\n";
                // removed solved chars from $data
                return [$cell, array_shift($data)];
            }
        }
    }
}
