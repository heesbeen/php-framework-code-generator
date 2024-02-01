<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
;


return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,

        // Clean code rules
        'array_syntax' => ['syntax' => 'short'],
        'no_empty_statement' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_curly_braces' => true,
        'no_unused_imports' => true,
        'protected_to_private' => true,

        // Our own rules
        'cast_spaces' => true,
        'class_attributes_separation' => ['elements' => ['method' => 'one']],
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_functions' => true, 'import_constants' => null],
        'native_function_invocation' => true,
        'no_extra_blank_lines' => ['tokens' => [
            'attribute',
            'break',
            'case',
            'continue',
            'curly_brace_block',
            'default',
            'extra',
            'parenthesis_brace_block',
            'return',
            'square_brace_block',
            'switch',
            'throw',
            'use',
            'use_trait',
        ]],
        'ordered_class_elements' => [
            'order' => [
                // Miscellaneous class start stuff
                'use_trait', 'case',

                // Constants, then static properties, then normal properties
                'constant_public', 'constant_protected', 'constant_private',
                'property_public_static', 'property_protected_static', 'property_private_static',
                'property_public', 'property_protected', 'property_private',

                // Static (factory) methods
                'method_public_static', 'method_protected_static', 'method_private_static',

                // Special instance methods: constructor, destructor, __invoke
                'construct', 'destruct', 'method:__invoke',

                // PHPUnit's special methods like setUp and tearDown
                'phpunit',

                // Normal methods
                'method_public', 'method_protected', 'method_private',

                // Magic methods
                'magic',

                // And finally, jsonSerialize
                'method:jsonSerialize',
            ],
            'sort_algorithm' => 'alpha', // Sort all items in one category alphabetically
        ],
        'ordered_imports' => ['imports_order' => ['class', 'function', 'const'], 'sort_algorithm' => 'alpha'],
        'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
        'psr_autoloading' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arguments', 'arrays', 'match', 'parameters']],
    ])->setFinder($finder);