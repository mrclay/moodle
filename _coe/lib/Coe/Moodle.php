<?php

namespace Coe;

class Moodle {
    /**
     * @var string
     */
    protected $rootPath;

    /**
     * @return string
     */
    public function getRootPath()
    {
        if (! $this->rootPath) {
            $this->setRootPath();
        }
        return $this->rootPath;
    }

    /**
     * @param string $path
     */
    public function setRootPath($path = null)
    {
        if (! $path) {
            $path = dirname(dirname(dirname(__DIR__)));
        }
        $this->rootPath = $path;
    }
}
