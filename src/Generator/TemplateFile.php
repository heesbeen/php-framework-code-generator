<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Generator;

class TemplateFile implements FileInterface
{
    /**
     * @var string
     */
    protected string $fileName;

    /**
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'test';
    }
}
