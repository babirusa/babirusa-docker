<?php

namespace MP\Docker;

use MP\Docker\Process\DockerProcess;

class DockerBuilder
{
    /**
     * @var BuildContext
     */
    private $context;

    /**
     * DockerBuilder constructor.
     * @param BuildContext $context
     */
    public function __construct(BuildContext $context)
    {
        $this->context = $context;
    }

    /**
     * Build docker container from current directory with given options
     *
     * @param       $tag
     * @param array ...$args
     * @return DockerImage
     */
    public function build($tag, ...$args): DockerImage
    {
        $cmd = [
            'build', '-f', $this->context->dockerfile->getFilename()
        ];

        $process = new DockerProcess(
            array_merge(
                $cmd, $args, ['.']
            ),
            $this->context->dockerfile->getPath()
        );

        $process->run();

        return new DockerImage($tag);
    }
}
