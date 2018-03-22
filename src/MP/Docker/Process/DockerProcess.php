<?php

namespace MP\Docker\Process;

use Symfony\Component\Process\Process;

class DockerProcess extends Process
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $commandline, ?string $cwd = null, ?array $env = null, ?mixed $input = null, $timeout = 60)
    {
        parent::__construct(array_merge(['docker'], $commandline), $cwd, $env, $input, 300);
    }

    /**
     * {@inheritdoc}
     */
    public function run(callable $callback = null, array $env = array()): int
    {
        return parent::run($callback ?? function ($type, $buffer) {
                fwrite(((Process::ERR === $type) ? STDERR : STDOUT), $buffer);
            }, $env
        );
    }
}
