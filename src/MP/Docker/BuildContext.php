<?php

namespace MP\Docker;

use SplFileInfo;

class BuildContext
{
    /**
     * @var string
     */
    public $platform;

    /**
     * @var SplFileInfo
     */
    public $dockerfile;

    /**
     * BuildContext constructor.
     * @param string      $platform
     * @param SplFileInfo $dockerfile
     */
    public function __construct(string $platform, splFileInfo $dockerfile)
    {
        $this->platform = $platform;
        $this->dockerfile = $dockerfile;
    }
}
