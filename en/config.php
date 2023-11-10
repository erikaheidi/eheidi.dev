<?php

declare(strict_types=1);

return [
    'site_name' => 'EHeidi.dev',
    'site_description' => 'I write about things I enjoy doing in my free time. Coding, Linux, 3D Printing, and other tech stuff...',
    'data_path' => __DIR__ . '/content',
    'output_path' => __DIR__ . '/public',
    'cache_path' => __DIR__ . '/var/cache',
    // Set site_index if you want a custom index page
    'site_index' => 'about/erika',
    'site_index_tpl' => 'content/index.html.twig',
];
