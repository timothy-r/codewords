<?php

require_once(__DIR__. '/vendor/autoload.php');

use Codewords\Game;
use Codewords\StrategyB;
use Codewords\Dictionary\SortedDictionary;
use Codewords\Board\HtmlTableBoardRenderer;

function usage()
{
    print "run.php \$data_file\n";
    exit;
}

/**
* run the application using $arg 1 as the data
*/
if (count($argv) < 2){
    usage();
}

$file = $argv[1];
if (!is_readable($file)){
    usage();
}

$data = file_get_contents($file);

$dict = new SortedDictionary(__DIR__."/config/dict-3");
$game = new Game($data, $dict);
$renderer = new HtmlTableBoardRenderer;
print $renderer->render($game->getBoard());

$strategy = new StrategyB;

$strategy->solve($game);

print $renderer->render($game->getBoard());
