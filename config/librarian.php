<?php

declare(strict_types=1);

return [
    // Global Site Information
    'site_author' => envconfig('SITE_AUTHOR', '@erikaheidi'),
    'site_url' => envconfig('SITE_URL', 'http://localhost:8000'),
    'site_root' => envconfig('SITE_ROOT', '/'),
    'site_about' => envconfig('SITE_ABOUT', 'about/erika'),

    'templates_path' => __DIR__ . '/../app/Resources/themes/onepagers',
    'posts_per_page' => 10,
    'stencil_dir' => __DIR__ . '/../app/Resources/stencil',
    'stencil_locations' => [
        'post' => __DIR__ . '/../content/post',
        'page' => __DIR__ . '/../content/page',
    ],
    'rss_feed' => envconfig('RSS_LINK', 'feed'),
    // Optional: Social links that show up on the top right
    'social_links' => [
        'Twitter' => envconfig('LINK_TWITTER', 'https://twitter.com/erikaheidi'),
        'Github'  => envconfig('LINK_GITHUB', 'https://github.com/erikaheidi'),
        'YouTube' => envconfig('LINK_YOUTUBE', 'https://youtube.com/c/erikaheidi'),
        'LinkedIn' => envconfig('LINK_LINKEDIN'),
        'Twitch' => envconfig('LINK_TWITCH'),
    ],
    'parser_params' => [
        'youtube' => [ 'width' => 900, 'height' => 400 ]
    ]

];
