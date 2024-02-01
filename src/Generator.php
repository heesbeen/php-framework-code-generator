<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator;

use Exception;
use PhpFrameworkCodeGenerator\Generator\FileInterface;
use PhpFrameworkCodeGenerator\Generator\JsonFile;
use PhpFrameworkCodeGenerator\Generator\PhpFile;
use PhpFrameworkCodeGenerator\Generator\TemplateFile;
use PhpFrameworkCodeGenerator\Generator\XmlFile;
use PhpFrameworkCodeGenerator\Generator\YamlFile;
use PhpFrameworkCodeGenerator\Snippets\SnippetInterface;
use Symfony\Component\Filesystem\Filesystem;

class Generator
{
    protected $buildDirectory = 'build/';
    /**
     * @var array
     */
    protected $files = [];
    /**
     * @var array
     */
    protected $inputData = [];

    /**
     * @var array
     */
    protected $jsonFiles = [];

    /**
     * @var PhpFile[]
     */
    protected $phpFiles = [];

    /**
     * @var array
     */
    protected $sharedData = [];
    /**
     * @var SnippetInterface[]
     */
    protected $snippets = [];
    /**
     * @var array
     */
    protected $templateFiles = [];
    /**
     * @var array
     */
    protected $xmlFiles = [];

    /**
     * @var array
     */
    protected $yamlFiles = [];

    public function addSharedData(string $key, $value)
    {
        $this->sharedData[$key] = $value;
    }

    /**
     * @param  SnippetInterface $snippet
     * @return void
     */
    public function addSnippet(SnippetInterface $snippet)
    {
        $snippet->setGenerator($this);
        $this->snippets[$snippet->getCode()] = $snippet;
    }

    /**
     * @return void
     */
    public function build()
    {
        $fileSystem = new Filesystem();
        foreach ($this->getFiles() as $fileName => $file) {
            $fileSystem->dumpFile($this->buildDirectory . $fileName, (string) $file);
        }
    }

    /**
     * @return void
     */
    public function generate()
    {
        foreach ($this->snippets as $snippet) {
            $snippetData = $this->inputData[$snippet->getCode()] ?? [];
            $snippet->addSnippetData($snippetData);
            $snippet->generate();
        }
    }

    /**
     * @return FileInterface[]
     */
    public function getFiles(): array
    {
        $this->files = array_merge(
            $this->phpFiles,
            $this->xmlFiles,
            $this->templateFiles,
            $this->jsonFiles,
            $this->yamlFiles,
        );
        return $this->files;
    }

    /**
     * @return array
     */
    public function getInputData(): array
    {
        return $this->inputData;
    }

    public function getInputFields(): array
    {
        $fields = [];
        foreach ($this->snippets as $snippet) {
            $fields[$snippet->getCode()]['fields'] = $snippet->getInputFields();
            $fields[$snippet->getCode()]['can_be_used_multiple_times'] = $snippet->canBeUsedMultipleTimes();
        }
        return $fields;
    }

    /**
     * @param  string $fileName
     * @return JsonFile
     */
    public function getJsonFile(string $fileName): JsonFile
    {
        if (isset($this->jsonFiles[$fileName])) {
            return $this->jsonFiles[$fileName];
        }

        return $this->jsonFiles[$fileName] = new JsonFile($fileName);
    }

    /**
     * @param  string $fileName
     * @return PhpFile
     */
    public function getPhpFile(string $fileName): PhpFile
    {
        if (isset($this->phpFiles[$fileName])) {
            return $this->phpFiles[$fileName];
        }

        return $this->phpFiles[$fileName] = new PhpFile($fileName, 'test', 'test');
    }

    public function getSharedData(string $key)
    {
        return $this->sharedData[$key];
    }

    public function getSnippet(string $snippetCode): SnippetInterface
    {
        if (isset($this->snippets[$snippetCode]) === false) {
            throw new Exception('Snippet ' . $snippetCode . ' does not exist');
        }
        return $this->snippets[$snippetCode];
    }

    /**
     * @param  string $fileName
     * @return TemplateFile
     */
    public function getTemplateFile(string $fileName): TemplateFile
    {
        if (isset($this->templateFiles[$fileName])) {
            return $this->templateFiles[$fileName];
        }

        return $this->templateFiles[$fileName] = new TemplateFile($fileName);
    }

    /**
     * @param  string $fileName
     * @return XmlFile
     */
    public function getXmlFile(string $fileName): XmlFile
    {
        if (isset($this->xmlFiles[$fileName])) {
            return $this->xmlFiles[$fileName];
        }

        return $this->xmlFiles[$fileName] = new XmlFile($fileName);
    }

    /**
     * @param  string $fileName
     * @return YamlFile
     */
    public function getYamlFile(string $fileName): YamlFile
    {
        if (isset($this->yamlFiles[$fileName])) {
            return $this->yamlFiles[$fileName];
        }

        return $this->yamlFiles[$fileName] = new YamlFile($fileName);
    }

    public function setBuildDirectory(string $buildDirectory)
    {
        $this->buildDirectory = $buildDirectory;
    }

    /**
     * @param  array $inputData
     * @return void
     */
    public function setInputData(string $snippetCode, array $inputData)
    {
        $this->validateInputData($snippetCode, $inputData);

        $snippet = $this->getSnippet($snippetCode);

        if ($snippet->canBeUsedMultipleTimes() === false && isset($this->inputData[$snippetCode])) {
            throw new Exception('Snippet ' . $snippetCode . ' can only be used once');
        }

        $this->inputData[$snippetCode][] = $inputData;
    }

    public function validateInputData(string $snippetCode, array $inputData)
    {
        if (isset($this->getInputFields()[$snippetCode]) === false) {
            throw new Exception('Snippet ' . $snippetCode . ' does not exist');
        }

        $fields = $this->getInputFields()[$snippetCode]['fields'];
        foreach ($fields as $field) {
            if ($field->isRequired() && !isset($inputData[$field->getName()])) {
                throw new Exception('Field ' . $field->getName() . ' is required');
            }
        }
    }
}
