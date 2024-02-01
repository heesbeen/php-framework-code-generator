<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Input;

interface InputFieldInterface
{
    /**
     * @return array
     */
    public function getChoices(): array;

    /**
     * @return string
     */
    public function getDefaultValue(): string;

    /**
     * @return string
     */
    public function getFieldType(): string;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getRegexValidator(): string;

    /**
     * @return string
     */
    public function getRegexValidatorMsg(): string;

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @param  array $choices
     * @return InputField
     */
    public function setChoices(array $choices): InputField;

    /**
     * @param  string $defaultValue
     * @return InputField
     */
    public function setDefaultValue(string $defaultValue): InputField;

    /**
     * @param  string $fieldType
     * @return InputField
     */
    public function setFieldType(string $fieldType): InputField;

    /**
     * @param  bool $required
     * @return InputField
     */
    public function setIsRequired(bool $required): InputField;

    /**
     * @param  string $label
     * @return InputField
     */
    public function setLabel(string $label): InputField;

    /**
     * @param  string $name
     * @return InputField
     */
    public function setName(string $name): InputField;

    /**
     * @param  string $regexValidator
     * @return InputField
     */
    public function setRegexValidator(string $regexValidator): InputField;

    /**
     * @param  string $regexValidatorMsg
     * @return InputField
     */
    public function setRegexValidatorMsg(string $regexValidatorMsg): InputField;
}
