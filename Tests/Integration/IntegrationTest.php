<?php

abstract class IntegrationTest extends PHPUnit_Framework_TestCase
{

    protected function getFixture($name)
    {
        $file = __DIR__ . '/../fixtures/' . $name;
        if (is_file($file)){
            return file_get_contents($file);
        }
        throw new Exception("File $file does not exist");
    }
}
