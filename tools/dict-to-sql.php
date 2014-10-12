<?php

use Codewords\Dictionary\FileDictionary;

require_once (__DIR__.'/../vendor/autoload.php');

/**
* Take a dictionary and generate sql to import into an rdbms
*/
function usage() {
    print "dict-to-sql dict_file\n";
    exit();
}
if (count($argv) < 2 ){
    usage();
}

$dict_file = $argv[1];
if (!is_file($dict_file)){
    useage();
}

$dictionary = new FileDictionary($dict_file);

// get longest word
$longest = $dictionary->longestWord();

// iterate through words
for ($i =1; $i <= $longest; $i++) {
    // write out sql statements
    $words = $dictionary->words($i);
    foreach ($words as $word) {
        printf("INSERT INTO dictionary (word, length) VALUES ('%s', %d);\n", strtolower(trim($word)), $i); 
    }
}
