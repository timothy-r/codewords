<?php namespace Codewords\Solver;

use Codewords\IFinder;
use Codewords\IDictionary;
use Codewords\Board\Board;
use Codewords\Board\Cell;

/**
* Finds Cells that may be a specific Letter
*/
class FindLetter implements IFinder
{
    /**
    * @var string
    */
    protected $letter;

    /**
    * @var array
    */
    protected $rules;
    
    protected $dictionary;

    public function __construct(IDictionary $dictionary, $letter, array $rules)
    {
        $this->dictionary = $dictionary;
        $this->letter = $letter;
        $this->rules = $rules;
    }

    /**
    * @return array of Cell objects
    */
    public function solve(Board $board)
    {
        $results = [];
        
        $cells = $board->getCells();
        foreach($cells as $cell){
            #print __METHOD__."\n";
            #var_dump($cell->getNumber());
            $character = $cell->getCharacter();

            if ($character === $this->letter){
                return [$cell];
            }
            
            // char is set but it's not this one
            if ($character !== null) {
                continue;
            }
            
            if ($this->applyRules($cell)){
                $results[]= $cell;
            }
        }

        // use dictionary to test words that contain this cell
        if (count($results) !== 1){
            $len = count($results);
            for($i = 0; $i < $len; $i++){
                if (!$this->testDictionary($results[$i])){
                    unset($results[$i]);
                }
            }
        } else {
            //printf("Only one result for '%s' so not testing dictionary\n", current($results)->getCharacter());

        }
        return $results;
    }
    
    /**
    * Test that all Rules of this Finder pass
    */
    protected function applyRules(Cell $cell)
    {
        foreach($this->rules as $rule){
            if (!$rule->passes($cell)){
                #print __METHOD__. " fails for {$cell->getNumber()}\n";
                return false;
            }
        }
        return true;
    }

    /**
    * consider factoring this method out into a separate class - a rule class?
    */
    protected function testDictionary(Cell $cell)
    {
        // get words that contain $cell
        $words = $cell->getWords();
        $word_pattern = new WordPattern($cell->getBoard()->getCells());
        
        #print __METHOD__ . " cell = " . $cell->getNumber() . " {$this->letter} words = " . count($words)."\n";

        foreach ($words as $word){
            // create a pattern to test dictionary with
            $pattern = $word_pattern->make(strtolower($this->letter), $cell, $word);
            #print "$pattern\n";
            $matches = $this->dictionary->find($pattern, $word->length());
            if (count($matches) > 0){
                #print "$pattern\n";
                #var_dump($matches);
            }
            // if no results are returned then return false from this method
            if (count($matches) == 0){
                #if ('n' == $this->letter){
                #    print "cell {$cell->getNumber()} no matches for n with $pattern\n";
                #}
                return false;
            }
        }

        // we found matches in the dictionary for all the Words on the Board for this Cell
        return true;
    }
}
