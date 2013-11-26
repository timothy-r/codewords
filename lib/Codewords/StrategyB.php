<?php namespace Codewords;

use Codewords\Game;
use Codewords\Solver\FinderFactory;

class StrategyB
{
    public function solve(Game $game)
    {
        $data = ['e','t','a','o','i','n','s','h','r','d','l','c','u','m','w','f','g','y','p','b','v','k','j','x','q','z'];
        $factory = new FinderFactory($game);
        
        $sort_func = function($a, $b) {if ($a['count'] == $b['count']){return 0;} return ($a['count'] < $b['count']) ? -1 : 1; };

        // pass one - get possible cells for each letter 
        $total = $this->generateCellOptions($game, $factory, $data);
        $total = $this->setCellCharacters($total);

        usort($total, $sort_func);

        $numbers = array_map(function($item){ return $item['letter'];}, $total);
        print implode(',', $numbers) . "\n";

        // pass two - starting with the letters that have the fewest options
        // try setting each one in turn and test all the other letters
        // if we find a cell with only one possible value set it
        foreach ($total as $item){
            // try setting cells to their possible values then generate options for each other Cell
            $options = $item['results'];
            print "Second pass for {$item['letter']}\n";
            foreach ($options as $cell){
                print "Testing cell {$cell->getNumber()} with letter {$item['letter']}\n";
                $cell->setCharacter($item['letter']);
                $results = $this->generateCellOptions($game, $factory, $data);
                // check results
                $cell->setCharacter(null);
            }

        }

        // carry on
    }

    protected function setCellCharacters(array $total)
    {
        $result = [];
        foreach($total as $item){
            if ($item['count'] == 1){
                $cell = current($item['results']);
                $cell->setCharacter($item['letter']);
                print "Setting Cell {$cell->getNumber()} to {$item['letter']}\n";
                // remove item here
            } else {
                $result []= $item;
            }
        }
        return $total;
    }

    protected function generateCellOptions(Game $game, FinderFactory $factory, array $letters)
    {
        $total = [];
        foreach($letters as $letter){
            $finder = $factory->create($letter);
            $results = $finder->solve($game);
            $total []= ['results' => $results, 'letter' => $letter, 'count' => count($results)];
            $numbers = array_map(function($cell){ return $cell->getNumber();}, $results);
            printf("%s results %s\n", $letter, implode(',', $numbers));
        }
        return $total;
    }
}
