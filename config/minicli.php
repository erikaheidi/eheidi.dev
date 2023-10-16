<?php

declare(strict_types=1);

return [
    /****************************************************************************
     * Minicli Settings
     * You shouldn't need to change the next settings,
     * but you are free to do so at your own risk.
     *****************************************************************************/
    'app_path' => [
        __DIR__ . '/../app/Command',
        '@librarianphp/command-help',
        '@librarianphp/command-create',
        '@librarianphp/command-cache',
        '@librarianphp/command-web',
        '@librarianphp/command-build',
    ],
    'theme' => 'unicorn',
];
