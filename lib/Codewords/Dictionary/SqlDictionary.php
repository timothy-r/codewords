<?php namespace Codewords\Dictionary;

use Codewords\DictionaryInterface;
use Doctrine\DBAL\Connection;

/**
* implements DictionaryInterface using an sql database as storage 
*/
class SqlDictionary implements DictionaryInterface
{
    /**
    * @var Doctrine\DBAL\Statement
    */
    protected $query_statement;

    /**
    * @var Doctrine\DBAL\Statement
    */
    protected $words_statement;

    public function __construct(Connection $connection)
    {   
        $sql = 'SELECT word from dictionary WHERE word REGEXP :pattern AND length = :length';
        $this->query_statement = $connection->prepare($sql);

        $sql = 'SELECT word from dictionary WHERE length = :length';
        $this->words_statement = $connection->prepare($sql);
    }

    /**
    * @return array of matching words
    */
    public function find($pattern, $length)
    {
        $this->query_statement->bindValue('pattern', $pattern);
        $this->query_statement->bindValue('length', $length);
        $this->query_statement->execute();
        $rows = $this->query_statement->fetchAll();
        
        $words = [];
        foreach ($rows as $row){
            $words []= $row[0];
        }
        
        return $words;
    }

    public function words($length)
    {
        $this->words_statement->bindValue('length', $length);
        $this->words_statement->execute();
        $rows = $this->words_statement->fetchAll();
        
        $words = [];
        foreach ($rows as $row){
            $words []= $row[0];
        }
        
        return $words;
    }

    public function longestWord()
    {
    }
}
