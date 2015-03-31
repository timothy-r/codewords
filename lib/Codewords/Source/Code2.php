<?php namespace Codewords\Source;

use Codewords\SourceInterface;

class Code2 implements SourceInterface
{
    public function read($data)
    {
        $xml = $this->convertStringToXml($data);
        $data = $this->convertXmlToArray($xml);
        $csv = $this->convertArrayToCsv($data);
        return $csv;
    }
    
    protected function convertArrayToCsv($data)
    {
        $csv = '';
        foreach($data as $row){
            $csv .= implode(',',$row). "\n";
        }
        return $csv;
    }

    protected function convertXmlToArray($xml)
    {
        $data = [];

        $doc = new \DomDocument();
        $doc->loadXml($xml);
        $cells = $doc->getElementsByTagName('cell');
        foreach($cells as $cell){
            $x = (int) $cell->getAttribute('x');
            $y = (int) $cell->getAttribute('y');
            if ($cell->hasAttribute('number')){
                $value = $cell->getAttribute('number');
            } else {
                $value = 'x';
            }
            // x is the horizontal y is the vertical
            if (!isset($data[$y])){
                $data[$y] = [];
            }
            $data[$y][$x] = $value;
        }
        return $data;
    }

    /** 
    * strip out non-xml chars and read xml into a DomDocument 
    */
    protected function convertStringToXml($data)
    {
        // remove all chars up to the first '<'
        $pos = strpos($data, '<');
        $data = substr($data, $pos);
        // remove trailing '";'
        $data = rtrim($data, '";');
        // remove '\r\n' and '\'
        $matches = preg_replace('#\\\r\\\n#', '', $data);
        $matches = preg_replace('#\\\#', '', $matches);
        return $matches;
    }
}
