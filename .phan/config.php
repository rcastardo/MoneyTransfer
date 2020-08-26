<?php

use Phan\Issue;

return [
    'target_php_version' => '7.2',
    'allow_missing_properties' => true,
    'null_casts_as_any_type' => true,
    'null_casts_as_array' => true,
    'array_casts_as_null' => true,
    'scalar_implicit_cast' => true,
    'scalar_array_key_cast' => true,
    'scalar_implicit_partial' => [],
    'strict_method_checking' => false,
    'strict_param_checking' => false,
    'strict_return_checking' => false,
    'ignore_undeclared_variables_in_global_scope' => true,
    'ignore_undeclared_functions_with_known_signatures' => true,
    'backward_compatibility_checks' => false,
    'check_docblock_signature_return_type_match' => false,
    'prefer_narrowed_phpdoc_param_type' => true,
    'prefer_narrowed_phpdoc_return_type' => true,
    'analyze_signature_compatibility' => false,
    'phpdoc_type_mapping' => [],
    'dead_code_detection' => false,
    'unused_variable_detection' => false,
    'quick_mode' => true,
    'simplify_ast' => true,
    'generic_types_enabled' => true,
    'globals_type_map' => [],
    'minimum_severity' => Issue::SEVERITY_NORMAL,
    'suppress_issue_types' => [],
    'exclude_file_regex' => '@^vendor/.*/(tests?|Tests?)/@',
    'exclude_file_list' => [],
    'directory_list' => [
        'app/',
    ],
    'exclude_analysis_directory_list' => [
        'vendor/',
    ],
    'plugins' => [
        'AlwaysReturnPlugin',
        'UnreachableCodePlugin',
        'DollarDollarPlugin',
        'DuplicateArrayKeyPlugin',
        'PregRegexCheckerPlugin',
        'PrintfCheckerPlugin',
    ],
];
