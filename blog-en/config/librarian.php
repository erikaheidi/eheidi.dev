<?php

declare(strict_types=1);

return [
    /****************************************************************************************
     * Librarian main config
     * Values set here will overwrite default configuration from the /config dir.
     *****************************************************************************************/

    // Site Information
    'site_name' => 'EHeidi.dev',
    'site_author' => '@erikaheidi',
    'site_description' => 'I write about the things I like. Coding, tech writing, Linux, devOps, 3D Printing, and other tech stuff...',
    'site_url' => envconfig('SITE_URL', 'http://localhost:8000'),
    'site_root' => envconfig('SITE_ROOT', '/'),
    'site_about' => envconfig('SITE_ABOUT', 'about/erika'),
    // Set site_index if you want a custom index page
    'site_index' => 'about/erika',
    'posts_per_page' => 10,
    'templates_path' => __DIR__ . '/../../Resources/themes/onepagers',
    'data_path' => __DIR__ . '/../content',
    'cache_path' => __DIR__ . '/../var/cache',
    'stencil_dir' => __DIR__ . '/../../Resources/stencil',
    'stencil_locations' => [
        'post' => __DIR__ . '/../content/post',
        'page' => __DIR__ . '/../content/page',
    ],
    'rss_feed' => php_sapi_name() !== 'cli' ? 'feed' : 'feed.rss',
    // Optional: Social links that show up on the top right
    'social_links' => [
        'Twitter' => envconfig('LINK_TWITTER'),
        'Github' => envconfig('LINK_GITHUB', 'https://github.com/erikaheidi/eheidi.dev'),
        'YouTube' => envconfig('LINK_YOUTUBE'),
        'LinkedIn' => envconfig('LINK_LINKEDIN'),
        'Twitch' => envconfig('LINK_TWITCH'),
    ],
];
