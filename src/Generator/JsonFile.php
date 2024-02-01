<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Generator;

class JsonFile implements FileInterface
{
    /**
     * @var string
     */
    protected string $fileName;
    /**
     * @var array
     */
    protected array $jsonData = [];

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
        $this->jsonData = array_merge_recursive($this->jsonData, $data);
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
        return json_encode($this->jsonData, JSON_PRETTY_PRINT);
    }
}
