<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Source\CodeWordServer;
use Codewords\Test\FixtureTrait;

class CodeWordServerTest extends PHPUnit_Framework_TestCase
{
    use FixtureTrait;

    public function getFixtures()
    {
        return [
            ['data-9.aspx', 'data-9.csv'],
        ];
    }
    
    /**
    * @dataProvider getFixtures
    */
    public function testReadData($fixture, $expected)
    {
        $data = $this->getFixture($fixture);
        $reader = new CodeWordServer;
        $result = $reader->read($data);
        $expected = $this->getFixture($expected);
        #$this->assertSame($expected, $result); 
    }

}
