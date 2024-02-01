<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Generator;

use FluidXml\FluidXml;

class XmlFile implements FileInterface
{
    /**
     * @var string
     */
    protected string $fileName;

    /**
     * @var FluidXml
     */
    protected FluidXml $xmlClass;

    /**
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->xmlClass = new FluidXml([]);
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return FluidXml
     */
    public function getXmlClass(): FluidXml
    {
        return $this->xmlClass;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->xmlClass->xml();
    }
}
