<?php namespace Codewords\Test;

trait FixtureTrait
{
    protected function getFixture($name)
    {
        $file = __DIR__ . '/../../../Tests/fixtures/' . $name;
        if (is_file($file)){
            return file_get_contents($file);
        }
        throw new \Exception("File $file does not exist");
    }

    protected function requireFixture($name)
    {
        $file = __DIR__ . '/../../../Tests/fixtures/' . $name;
        if (is_file($file)){
            return require_once($file);
        }
        throw new \Exception("File $file does not exist");
    }
}
