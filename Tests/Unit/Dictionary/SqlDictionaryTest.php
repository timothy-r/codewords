<?php

use Ace\Codewords\Dictionary\SqlDictionary;

/**
* @group unit
*/
class SqlDictionaryTest extends PHPUnit_Framework_TestCase
{

    protected $mock_query_statement;
    protected $mock_words_statement;
    protected $mock_longest_statement;

    protected $mock_db_connection;
    
    public function setUp()
    {
        parent::setUp();
        $this->givenAMockQueryStatement();
        $this->givenAMockWordsStatement();
        $this->givenAMockLongestStatement();
        $this->givenAMockDbConnection();
    }

    public function testFindReturnsAllMatchingWords()
    {
        $pattern = '^.a.$';
        $length = 3;

        // set mock db expectations
        $this->mock_query_statement->expects($this->at(0))
            ->method('bindValue')
            ->with('pattern', $pattern);

        $this->mock_query_statement->expects($this->at(1))
            ->method('bindValue')
            ->with('length', $length);

        $this->mock_query_statement->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(0));

        $this->mock_query_statement->expects($this->any())
            ->method('fetchAll')
            ->will($this->returnValue([['cat'],['mat']]));

        $dictionary = new SqlDictionary($this->mock_db_connection);

        $result = $dictionary->find($pattern, $length);

        $this->assertTrue(is_array($result));
        $this->assertSame(2, count($result));
        $this->assertTrue(in_array('cat', $result));
        $this->assertTrue(in_array('mat', $result));
    }

    public function getWordsFixtures()
    {
        return [
            [0, []],
            [3, [['boy'],['dog'],['pop']]],
        ];
    }

    /**
    * @dataProvider getWordsFixtures
    */
    public function testWordsReturnsArrayOfWords($length, $words)
    {
        // set mock db expectations
        $this->mock_words_statement->expects($this->at(0))
            ->method('bindValue')
            ->with('length', $length);

        $this->mock_words_statement->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(0));

        $this->mock_words_statement->expects($this->any())
            ->method('fetchAll')
            ->will($this->returnValue($words));

        $dictionary = new SqlDictionary($this->mock_db_connection);

        $result = $dictionary->words($length);
        $this->assertTrue(is_array($result), "Expected SqlDictionary::words() to return an array");
        $this->assertSame(count($words), count($result));
    }
    
    public function testLongestWordReturnsZeroWhenDictionayIsEmpty()
    {
        $this->mock_words_statement->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(0));

        $this->mock_words_statement->expects($this->any())
            ->method('fetchAll')
            ->will($this->returnValue([]));

        $dictionary = new SqlDictionary($this->mock_db_connection);

        $result = $dictionary->longestWord();
        $this->assertSame(0, $result, "Expected SqlDictionary::longestWord() to return 0");
    }

    protected function givenAMockQueryStatement()
    {
        $this->mock_query_statement = $this->getMockStatement();
    }
    
    protected function givenAMockWordsStatement()
    {
        $this->mock_words_statement = $this->getMockStatement();
    }
    
    protected function givenAMockLongestStatement()
    {
        $this->mock_longest_statement = $this->getMockStatement();
    }
    
    protected function getMockStatement()
    {
        return $this->getMockBuilder('Doctrine\DBAL\Statement')
            ->setMethods(['bindValue', 'execute', 'fetchAll'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function givenAMockDbConnection()
    {
        $this->mock_db_connection = $this->getMockBuilder('Doctrine\DBAL\Connection')
            ->setMethods(['prepare'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->mock_db_connection->expects($this->at(0))
            ->method('prepare')
            ->will($this->returnValue($this->mock_query_statement));

        $this->mock_db_connection->expects($this->at(1))
            ->method('prepare')
            ->will($this->returnValue($this->mock_words_statement));

        $this->mock_db_connection->expects($this->at(2))
            ->method('prepare')
            ->will($this->returnValue($this->mock_longest_statement));
    }
}

