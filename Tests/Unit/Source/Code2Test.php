<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Source\Code2;
use Codewords\Test\FixtureTrait;

class Code2Test extends BaseTest
{
    use FixtureTrait;

    public function getFixtures()
    {
        return [
            ['data-5.js', 'data-5.csv'],
            ['code2_xml.js', 'code2.csv'],
            ['CODEWORDPUZZLE_XML.js', 'CODEWORDPUZZLE_XML.csv'],
            ['httpusernamefilename_xml.js', 'httpusernamefilename_xml.csv']
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
