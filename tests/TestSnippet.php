<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGeneratorTests;

use PhpFrameworkCodeGenerator\Input\InputField;
use PhpFrameworkCodeGenerator\Snippets\Snippet;
use PhpFrameworkCodeGenerator\Snippets\SnippetInterface;

class TestSnippet extends Snippet implements SnippetInterface
{
    public function generate(): void
    {
        $controllerPhpFile = $this->getGenerator()->getPhpFile('Controller/TestController.php');
        $controllerPhpFile->getPhpClass()->addMethod('test');

        $controllerPhpFile = $this->getGenerator()->getPhpFile('Controller/TestController.php');
        $controllerPhpFile->getPhpClass()->addMethod('test2');

        $eventsXmlFile = $this->getGenerator()->getXmlFile('Example/Events.xml');
        $eventsXmlFile->getXmlClass()->appendSibling('event', ['name' => 'test']);

        $composerJsonFile = $this->getGenerator()->getJsonFile('composer.json');
        $composerJsonFile->addData(['require' => ['test' => '1.0.0']]);

        $composerJsonFile2 = $this->getGenerator()->getJsonFile('composer.json');
        $composerJsonFile2->addData(['require' => ['test2' => '1.0.0']]);

        $yamlFile = $this->getGenerator()->getYamlFile('test.yaml');
        $yamlFile->addData(['test' => ['test' => 'test']]);
    }

    public function getCode(): string
    {
        return 'example';
    }

    public function getInputFields(): array
    {
        return [
            (new InputField())
                ->setName('name')
                ->setLabel('Name')
                ->setIsRequired(true)
                ->setRegexValidator('/^[a-zA-Z0-9_]+$/')
                ->setRegexValidatorMsg('Only letters, numbers and underscores are allowed')
                ->setDefaultValue('tests')
                ->setChoices([]),
        ];
    }

    public function getLabel(): string
    {
        return 'Example Label';
    }
}
