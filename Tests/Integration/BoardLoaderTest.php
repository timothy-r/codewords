<?php
require_once(__DIR__ . '/IntegrationTest.php');

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Test\FixtureTrait;
use Codewords\BoardLoader;

/**
* @group integration
*/
class BoardLoaderTest extends IntegrationTest
{
    use IntegrationFixtureTrait;
    use FixtureTrait;

    /**
    * @dataProvider getValidGameData
    */
    public function testLoadBoard($data)
    {
        $loader = new BoardLoader;
        $fixture = $this->getFixture($data);
        $board = $loader->load($fixture);
        $this->assertInstanceOf('Codewords\Board\Board', $board);
    }
}
