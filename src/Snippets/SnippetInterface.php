<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Snippets;

use PhpFrameworkCodeGenerator\Generator;
use PhpFrameworkCodeGenerator\Input\InputFieldInterface;

interface SnippetInterface
{
    public function generate(): void;

    public function getCode(): string;

    /**
     * @return InputFieldInterface[]
     */
    public function getInputFields(): array;

    public function getLabel(): string;

    public function setGenerator(Generator $generator): void;
}
