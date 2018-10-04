<?php

namespace Iris\Storage;

class File
{
    protected $filePath;

    protected $name;

    public function __construct($name, $filePath)
    {
        $this->name = $name;
        $this->filePath = $filePath;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }
}
