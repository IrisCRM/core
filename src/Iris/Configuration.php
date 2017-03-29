<?php

namespace Iris;

class Configuration
{
    /**
     * Configuration
     *
     * Keys - parameter name in lowercase with path, for example: db.host
     *
     * @var array
     */
    protected $data;

    /**
     * Configuration constructor.
     * @param \SimpleXMLElement $xml
     */
    public function __construct($xml)
    {
        $this->data = $this->readFromXml($xml);
    }

    /**
     * Recursively reads xml file with configuration
     *
     * It is temporary solution. Later XML will be replaced to set of PHP files.
     *
     * @param \SimpleXMLElement $xml
     * @param string $prefix
     * @param array $data
     * @return array
     */
    protected function readFromXml($xml, $prefix = '', $data = [])
    {
        /** @var \SimpleXMLElement $item */
        foreach ($xml as $key => $item)
        {
            $currentPrefix = $prefix . ($prefix ? '.' : '') . $key;

            foreach ($item->attributes() as $attrName => $attrValue) {
                $value = (string)$attrValue;

                // @fixme Temporary crutch (current XML schema don't knows about attribute types)
                $value = $value === 'false' ? false : ($value === 'true' ? true : $value);

                $data[strtolower($currentPrefix . '.' . $attrName)] = $value;
            }

            if ($item->children()) {
                $data = $this->readFromXml($item, $currentPrefix, $data);
            }
            else {
                $data[strtolower($currentPrefix)] = (string)$item;
            }
        }
        return $data;
    }

    /**
     * Get configuration parameter value
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

}