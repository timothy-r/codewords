<?php
require_once(__DIR__ . '/../IntegrationTest.php');

use Codewords\Dictionary\SortedDictionary;

/**
* @group integration
*/
class SortedDictionaryTest extends IntegrationTest
{
    public function getFixtures()
    {
        return [
            ['^.a.$', ['bat', 'mat']],
            ['^.ra..$', ['iraqi', 'irate']],
            ['^sta....$', ['station', 'staunch', 'starved']],
        ];
    }

    /**
    * @dataProvider getFixtures
    */
    public function testFindReturnsAllMatchingWords($pattern, $expected)
    {
        $dictionary = new SortedDictionary(__DIR__.'/../../../config/dict-2');
        $result = $dictionary->find($pattern, strlen($expected[0]));
        
        $this->assertTrue(is_array($result));
        foreach ($expected as $exp) {
            $this->assertTrue(in_array($exp, $result));
        }
    }
}
