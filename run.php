<?php
require_once(__DIR__. '/vendor/autoload.php');

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

function usage()
{
    print "run.php \$data_file\n";
    exit;
}

function getDiContainer($file)
{
    $container = new ContainerBuilder();
    $loader = new XmlFileLoader($container, new FileLocator(__DIR__));
    $loader->load($file);
    return $container; 
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

$container = getDiContainer(__DIR__ . '/config/services.xml');

$game = $container->get('game');
$game->load($data);

$renderer = $container->get('renderer');
//print $renderer->render($game->getBoard());

$strategy = $container->get('strategy');
$strategy->solve();

print $renderer->render($game->getBoard());
