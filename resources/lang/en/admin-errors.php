<?php

return [
    'views' => [
        '401' => [
            'title' => '401.',
            'h2' => [
                'unauthorized' => '401 Unauthorized',
                '401' => '401.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Home',
                        ],
                        'unauthorized' => '401 Unauthorized',
                    ],
                ],
            ],
            'p' => [
                'dont' => 'You do not have Unauthorized',
            ],
            'button' => [
                'search' => 'Search',
            ],

        ],
        '403'=> [
            'title' => '403.',
            'h2' => [
                'unauthorized' => '403 Unauthorized',
                '403' => '403.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Home',
                        ],
                        'unauthorized' => '403 Unauthorized',
                    ],
                ],
            ],
            'p' => [
                'action-unauthorized' => 'This action is unauthorized.',
            ],
            'button' => [
                'search' => 'Search',
            ],
        ],
        '404'=> [
            'title' => '404.',
            'h2' => [
                'not-found' => '404 Not Found',
                '404' => '404.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Home',
                        ],
                        'not-found' => '404 Not Found',
                    ],
                ],
            ],
            'p' => [
                'dont' => "We're sorry, but the page you were looking for doesn't exist.",
            ],
            'button' => [
                'search' => 'Search',
            ],
        ],
        '500'=> [
            'title' => '500.',
            'h2' => [
                'not-found' => '500 Not Found',
                '500' => '500.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Home',
                        ],
                        'not-found' => '500 Not Found',
                    ],
                ],
            ],
            'p' => [
                'dont' => "We're sorry, but the page you were looking for doesn't exist.",
            ],
            'button' => [
                'search' => 'Search',
            ],
        ],
        '503' => [
            'title' => '503.',
        ],
        'link-expired' => [
            'title' => '403',
            'h2' => [
                'expired' => '403 Link expired',
                '403' => '403.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Home',
                        ],
                        'link-expired' => '403 Link expired',
                    ],
                ],
            ],
            'p' => [
                'expired' => 'Link expired',
            ],
        ],
    ],
];
