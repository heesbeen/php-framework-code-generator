<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGeneratorExample;

use PhpFrameworkCodeGenerator\Generator;
use PhpFrameworkCodeGeneratorTests\TestSnippet;
use PHPUnit\Framework\TestCase;

final class OutputTest extends TestCase
{
    public function testOutput(): void
    {
        $generator = new Generator();

        $generator->addSnippet(new TestSnippet());

        $generator->generate();

        $files = $generator->getFiles();

        foreach ($files as $fileName => $fileContent) {
            self::assertFileExists('tests/build/' . $fileName);
            self::assertStringEqualsFile('tests/build/' . $fileName, (string) $fileContent);
        }
    }
}
