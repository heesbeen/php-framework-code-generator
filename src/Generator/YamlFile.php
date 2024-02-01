<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Generator;

use Symfony\Component\Yaml\Dumper;

class YamlFile implements FileInterface
{
    /**
     * @var string
     */
    protected string $fileName;
    /**
     * @var array
     */
    protected array $yamlData = [];

    /**
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param array $data
     * @return void
     */
    public function addData(array $data)
    {
        $this->yamlData = array_merge_recursive($this->yamlData, $data);
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
        $yaml = new Dumper();
        return $yaml->dump($this->yamlData, 4);
    }
}
