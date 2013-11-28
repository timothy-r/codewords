<?php namespace Codewords\Source;

use Codewords\ISource;

class Code2 implements ISource
{
    public function read($data)
    {
        // strip out non-xml chars and read xml into a DomDocument 
        $xml = $this->convertToXml($data);
        $doc = new \DomDocument();
        $doc->loadXml($xml);
        print $doc->saveXml();
    }

    protected function convertToXml($data)
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
