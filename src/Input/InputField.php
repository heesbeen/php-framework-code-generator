<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Input;

use JsonSerializable;

class InputField implements InputFieldInterface, JsonSerializable
{
    /**
     * @var string
     */
    protected string $name;
    /**
     * @var array
     */
    private array|null $choices = null;
    /**
     * @var string
     */
    private string|null $defaultValue = null;
    /**
     * @var string
     */
    private string $fieldType;
    /**
     * @var string
     */
    private string $label;
    /**
     * @var string
     */
    private string|null $regexValidator = null;
    /**
     * @var string
     */
    private string|null $regexValidatorMsg = null;
    /**
     * @var bool
     */
    private bool $required = false;

    public static function create(
        string $name,
        string $label,
        string $fieldType,
    ): self {
        return new self($name, $label, $fieldType);
    }

    public function __construct(
        string $name,
        string $label,
        string $fieldType,
    ) {
        $this->fieldType = $fieldType;
        $this->label = $label;
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    public function getData(): array
    {
        return $this->jsonSerialize();
    }

    /**
     * @return string
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @return string
     */
    public function getFieldType(): string
    {
        return $this->fieldType;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRegexValidator(): string
    {
        return $this->regexValidator;
    }

    /**
     * @return string
     */
    public function getRegexValidatorMsg(): string
    {
        return $this->regexValidatorMsg;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param  array $choices
     * @return $this
     */
    public function setChoices(array $choices): self
    {
        $this->choices = $choices;
        return $this;
    }

    /**
     * @param  string $defaultValue
     * @return $this
     */
    public function setDefaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @param  string $fieldType
     * @return $this
     */
    public function setFieldType(string $fieldType): self
    {
        $this->fieldType = $fieldType;
        return $this;
    }

    /**
     * @param  bool $required
     * @return $this
     */
    public function setIsRequired(bool $required): self
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @param  string $label
     * @return $this
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param  string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param  string $regexValidator
     * @return $this
     */
    public function setRegexValidator(string $regexValidator): self
    {
        $this->regexValidator = $regexValidator;
        return $this;
    }

    /**
     * @param  string $regexValidatorMsg
     * @return $this
     */
    public function setRegexValidatorMsg(string $regexValidatorMsg): self
    {
        $this->regexValidatorMsg = $regexValidatorMsg;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'fieldType' => $this->fieldType,
            'required' => $this->required,
            'defaultValue' => $this->defaultValue,
            'choices' => $this->choices,
            'regexValidator' => $this->regexValidator,
            'regexValidatorMsg' => $this->regexValidatorMsg,
        ];
    }
}
