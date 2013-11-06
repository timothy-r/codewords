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
        $expected_char = null;
        $next_cell = $this->getNextUnsolvedCell();
        if (!$next_cell){
            return false;
        }
        $data = ['E','T','A','O','I','N','S','H','R','D','L','C','U','M','W','F','G','Y','P','B','V','K','J','X','Q','Z'];
        foreach ($data as $expected_char) { 
        //while (true) {
            if ($this->isCharacterSolved($expected_char)){
                continue;
            }
            //$expected_char = $this->getNextUnsolvedCharacter($expected_char);
            //var_dump($expected_cell);die;
            //if (!$expected_char){
            //    return false;
           // }

            // now guess this char based on standard letter frequencies
            //$expected_char = $this->getCharFromFrequency($index);
            print "Testing cell " . $next_cell->getNumber() . ' ' . $expected_char."\n";
            if ($this->testCharacter($next_cell, $expected_char)){
                // solve the character
                print "Solved cell " . $next_cell->getNumber() . ' ' . $expected_char."\n";
                $next_cell->setCharacter($expected_char);
                return true;
            }
            //die('here');
        }

        return false;
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
            $pattern = strtolower($pattern);

            #var_dump($char . ' ' . $pattern);

            if ($test){
                $matches = $this->game->getDictionary()->find($pattern);
                //var_dump($matches);
                if (!count($matches)){
                    var_dump($char . ' ' . $pattern. " didn't match any words");
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
   
    protected function isCharacterSolved($char)
    {
        $cells = $this->game->getCells();
        $cell = $cells->cellForCharacter($char);
        return !is_null($cell);
    }

    protected function getNextUnsolvedCharacter($current = null)
    {
        $data = ['E','T','A','O','I','N','S','H','R','D','L','C','U','M','W','F','G','Y','P','B','V','K','J','X','Q','Z'];
        $cells = $this->game->getCells();
        //var_dump($cells);
        for($i = 1; $i < 27; $i++){
            $cell = $cells->at($i);
            print "Character " . $cell->getNumber() . " " . $cell->getCharacter()."\n";
            print "$i\n";
            if ($character = $cell->getCharacter()){
                print "Character $character has been solved\n";
                $i = array_search($character, $data);
                //for($i = 0; $i < count($data); $i++){
                #    if ($data[$i] === $character){
                #        unset($data[$i]);
                #        break;
                #    }
                #}
                if ($i !== false) {
                    unset($data[$i]);
                }
            }
            if ($i > 11){
                die;
            }
        }
        var_dump($data);
die;
        // $data only contain unsolved chars
        // return next most popular
        #if ($i !== false) {
        #    unset($data[$i]);
        #}

        if (is_null($current)){
            return array_shift($data); 
        } else {
            // return next char after current
            while ($char = array_shift($data)){
                if ($char === $current){
                    if (count($data)){
                        return array_shift($data);
                    }
                }
            }
        }
        return '';
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

        foreach($frequencies as $number => $count) {
            // test to see if $number is solved yet
            $cell = $cells->at($number);

            if ($character !== $cell->getCharacter()){
                // removed solved chars from $data
                return $cell;
            }
        }
    }
}
