<?php

namespace MP\Docker;

use MP\Docker\Process\DockerProcess;

class DockerImage
{
    /**
     * @var string
     */
    private $tag;

    private $container;

    /**
     * DockerImage constructor.
     * @param string $tag
     */
    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return int
     */
    public function start()
    {
        $process = new DockerProcess(['create', $this->tag]);
        $process->run();

        $this->container = trim($process->getOutput());

        return $process->getExitCode();
    }

    /**
     * @param $source
     * @param $destination
     * @return int
     */
    public function extract($source, $destination)
    {
        return (new DockerProcess(['-D', 'cp', sprintf('%s:%s', $this->container, $source), $destination]))->run();
    }

    /**
     * @return int
     */
    public function destroy()
    {
        return (new DockerProcess(['rm', $this->container]))->run();
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }
}
