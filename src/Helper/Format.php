<?php

declare(strict_types=1);

namespace PhpFrameworkCodeGenerator\Helper;

class Format
{
    /**
     * @param  string $name
     * @return string
     */
    public static function camelCaseString(string $name): string
    {
        $getterName = '';
        foreach (explode('_', $name) as $part) {
            $getterName .= ucfirst($part);
        }
        return $getterName;
    }

    /**
     * @param  string $name
     * @param  string $prefix
     * @return string
     */
    public static function createPrefixedMethodName(string $name, string $prefix = 'get'): string
    {
        return sprintf('%s%s', $prefix, self::camelCaseString($name));
    }
}
