<?php

function read_dict($file)
{
    $dict = [];

    if (file_exists($file)){
        $dict = require_once($file);
    }

    // convert each item into a list
    foreach($dict as $key => &$item) {
        $item = explode("\n", $item);
    }
    return $dict;
}

function write_dict(array $dict, $file)
{
    // convert each item into a list
    foreach($dict as $key => &$item) {
        sort($item);
        $item = implode("\n", $item);
    }

    // write $dict back to $data file
    $str = var_export($dict, $return = true);

    file_put_contents($file, '<' . "?php\nreturn $str;\n");
}

// $in is a file with a list of words, one per line
// $data is the file to write the data to (it may exist already)
$in = $argv[1];
$data = $argv[2];

$dict = read_dict($data);

// read $in into a flat array
$lines = file($in);

$count = 0;
$min_length = 3;

// add each item in $new to $data;
foreach($lines as $word){
    $word = strtolower(trim($word));
    $len = strlen($word);
    if ($len < $min_length){
        continue;
    }

    // add to $dict
    if (!isset($dict[$len])){
        $dict[$len] = [];
    }
    if (!in_array($word, $dict[$len])){
        $dict[$len] []= $word;
    }
    $count++;
    if ($count % 100 == 0){
        print "$count\n";
    }
}

write_dict($dict, $data);

