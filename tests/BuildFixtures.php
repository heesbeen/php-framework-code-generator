<?php

declare(strict_types=1);

use PhpFrameworkCodeGenerator\Generator;

require '../vendor/autoload.php';

$generator = new Generator();

$generator->addSnippet(new PhpFrameworkCodeGeneratorTests\TestSnippet());

$generator->generate();

$generator->build();

foreach ($generator->getFiles() as $fileName => $fileContent) {
    echo $fileContent . "\n";
}
