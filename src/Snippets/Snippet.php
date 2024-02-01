<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Snippets;

use PhpFrameworkCodeGenerator\Generator;

abstract class Snippet implements SnippetInterface
{
    protected $canBeUsedMultipleTimes = true;
    protected Generator $generator;
    protected array $snippetData = [];

    public function addSnippetData(array $snippetData)
    {
        $this->snippetData = $snippetData;
    }

    public function canBeUsedMultipleTimes(): bool
    {
        return $this->canBeUsedMultipleTimes;
    }

    public function getGenerator(): Generator
    {
        return $this->generator;
    }

    public function setGenerator(Generator $generator): void
    {
        $this->generator = $generator;
    }
}
