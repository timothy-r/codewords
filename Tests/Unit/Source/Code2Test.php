<?php

use Ace\Codewords\Source\Code2;
use Ace\Codewords\Test\FixtureTrait;

class Code2Test extends PHPUnit_Framework_TestCase
{
    use FixtureTrait;

    public function getFixtures()
    {
        return [
            ['data-5.js', 'data-5.csv'],
            ['data-6.js', 'data-6.csv'],
            ['data-7.js', 'data-7.csv'],
            ['data-8.js', 'data-8.csv'],
        ];
    }
    
    /**
    * @dataProvider getFixtures
    */
    public function testReadData($fixture, $expected)
    {
        $data = $this->getFixture($fixture);
        $reader = new Code2;
        $result = $reader->read($data);
        $expected = $this->getFixture($expected);
        $this->assertSame($expected, $result); 
    }

}
