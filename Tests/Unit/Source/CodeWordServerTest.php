<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Test\FixtureTrait;

class CodeWordServer extends BaseTest
{
    use FixtureTrait;

    public function getFixtures()
    {
        return [
            ['CodeWordServer.aspx'],
        ];
    }
    
    /**
    * @dataProvider getFixtures
    */
    public function testReadData($fixture)
    {
        $data = $this->getFixture($fixture);

    }

}
