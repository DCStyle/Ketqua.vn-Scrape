<?php

return [
    'paths' => [
        [
            'our_paths' => [
                '/lien-he' => 'pages.contact',
                '/lich-mo-thuong' => 'pages.lottery_schedule',
            ],
            'type' => 'custom'
        ]
    ],
    'default_scrape' => [
        'source_url' => 'https://xskt.net',
        'main_selector' => '.container.max-w-1140px.position-relative',
        'template' => 'scrape.default'
    ],
    'source_domain' => 'xskt.net'
];
