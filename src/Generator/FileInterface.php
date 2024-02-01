<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Generator;

interface FileInterface
{
    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @return string
     */
    public function __toString(): string;
}
