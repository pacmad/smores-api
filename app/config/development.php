<?php
error_reporting(E_ALL);

// Override production configs for development environment
// this development environemnt is configured for docker usage
// app/config/development.php

$development = [
    'application' => [
        // where to store cache related files
        'cacheDir' => '/tmp/',
        // FQDN
        'publicUrl' => 'http://localhost:8080',
        // probably the same FQDN
        'corsOrigin' => 'https://localhost:8080',
        // should the api return additional meta data and enable additional server logging?
        'debugApp' => true,
        // where should system temp files go?
        'tempDir' => '/tmp/',
        // where should app generated logs be stored?
        'loggingDir' => '/tmp/',
        // what is the path after the FQDN?
        'baseUri' => '##partialurl##/v1/'
    ],
    // standard database configuration values
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'db',
        'username' => 'api',
        'password' => 'api',
        'dbname' => 'smores',
        'charset' => 'utf8'
    ],
    // enable security for controllers marked as secure?
    'security' => true,
//    'security' => false,

    // if secuirty is false, which user id to impersonate?
    // set to a user account with access to most routes for automated testing
    // owner access
    // 'securityUserId' => 595,
    // employee access
    'securityUserId' => 768,

    // used as a system wide prefix to all file storage paths
    'fileStorage' => [
        'basePath' => '/file_storage/'
    ]
];

// load defined security rules based on current environment
return array_merge_recursive_replace($development, require('security_rules/development.php'));