# Php Framework Code Generator

This is a code generator for php frameworks. It is designed to be extendable and can be used to generate code for any php framework.

Support file types:

- Php ( nette/php-generator )
- Xml ( servo/fluidxml )
- Template ( twig/twig )
- Yaml ( symfony/yaml )
- Json ( php-json )

## Installation

```bash composer require php-framework-code-generator/core```

## Additional Packages:

php-framework-code-generator/magento
php-framework-code-generator/example
php-framework-code-generator/frontend
php-framework-code-generator/api

## Example Usage

```php

<?php

use PhpFrameworkCodeGenerator\Generator;

require 'vendor/autoload.php';

$generator = new Generator();

// Add you framework code snippets
$generator->addSnippet(new \PhpFrameworkCodeGeneratorExample\Snippets\Example());

// Ask for the input per snippet
foreach ($generator->getInputFields() as $snippetCode => $inputFields) {
    echo $snippetCode . "\n";
    foreach ($inputFields as $inputField) {
        echo json_encode($inputField) . "\n";
        //print_r($inputField->getData());
    }
}

// Set the requested input per snippet. A snippet can be called multiple times with different input
$generator->setInputData('example', ['name' => 'testfield']);
$generator->setInputData('example', ['name' => 'testfield2']);

// Generate the code
$generator->generate();

// Generate the files in a folder
$generator->build();

// Get the generated files and show content
foreach ($generator->getFiles() as $fileName => $fileContent) {
    echo $fileContent . "\n";
}
```

##Example Snippet:

```php
<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGeneratorExample\Snippets;

use PhpFrameworkCodeGenerator\Input\InputField;
use PhpFrameworkCodeGenerator\Snippets\Snippet;
use PhpFrameworkCodeGenerator\Snippets\SnippetInterface;

class Example extends Snippet implements SnippetInterface
{
    public function generate(): void
    {
        foreach ($this->snippetData as $snippetData) {
            $controllerPhpFile = $this->getGenerator()->getPhpFile('Controller/TestController.php');
            $controllerPhpFile->getPhpClass()->addMethod($snippetData['name']);
        }

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

    public function getInputFields(): array
    {
        return [
            InputField::create(
                'name',
                'Name',
                'text',
            )->setIsRequired(true)
        ];
    }

    public function getLabel(): string
    {
        return 'Example Label';
    }

    public function getCode(): string
    {
        return 'example';
    }
}

```

##Credits

This package is heavily inspired by the architecture of Mage2gen.