<?php

namespace Iris\Storage;

use League\Flysystem\Adapter\Local;

class LocalSubdirectoryAdapter extends Local
{
    /**
     * @var int How many subdirectories must be in storage
     */
    protected $subLevels;

    /**
     * @var int How many digits must be in every subdirectory
     */
    protected $subLevelDigits;

    public function __construct(
        $root,
        $writeFlags = LOCK_EX,
        $linkHandling = self::DISALLOW_LINKS,
        $permissions = [],
        $pathLevels=2,
        $pathSize=2
    )
    {
        parent::__construct($root, $writeFlags, $linkHandling, $permissions);
        $this->subLevels = $pathLevels;
        $this->subLevelDigits = $pathSize;
    }

    /**
     * @inheritdoc
     */
    public function applyPathPrefix($path)
    {
        // Support legacy storage in single folder
        $location = $this->getPathPrefix() . ltrim($path, '\\/');
        if (file_exists($location)) {
            return $location;
        }

        $pathDigits = str_replace('-', '', $path);
        $subdirectories = '';
        for ($i = 0; $i < $this->subLevels; $i++) {
            $subdirectories .= substr($pathDigits, $i * $this->subLevelDigits, $this->subLevelDigits) . '/';
            $location = $this->getPathPrefix() . $subdirectories . ltrim($path, '\\/');
            if (file_exists($location)) {
                return $location;
            }
        }

        return $location;
    }

}
