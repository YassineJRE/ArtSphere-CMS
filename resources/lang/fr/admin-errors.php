<?php

return [
    'views' => [
        '401' => [
            'title' => '401.',
            'h2' => [
                'unauthorized' => '401 non autorisé',
                '401' => '401.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Accueil',
                        ],
                        'unauthorized' => '401 non autorisé',
                    ],
                ],
            ],
            'p' => [
                'dont' => "Vous n'avez pas d'autorisation",
            ],
            'button' => [
                'search' => 'Recherche',
            ],
            '403'=> [
                'title' => '403.',
                'h2' => [
                    'unauthorized' => '403 Non autorisé',
                    '403' => '403.',
                ],
                'nav' => [
                    'ul' => [
                        'li' => [
                            'link' => [
                                'home' => 'Accueil',
                            ],
                            'unauthorized' => '403 Non autorisé',
                        ],
                    ],
                ],
                'p' => [
                    'action-unauthorized' => "Cette action n'est pas autorisée.",
                ],
                'button' => [
                    'search' => 'Recherche',
                ],
            ],
        ],
        '404'=> [
            'title' => '404.',
            'h2' => [
                'not-found' => '404 non trouvé',
                '404' => '404.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Accueil',
                        ],
                        'not-found' => '404 non trouvé',
                    ],
                ],
            ],
            'p' => [
                'dont' => "Nous sommes désolés, mais la page que vous recherchez n'existe pas.",
            ],
            'button' => [
                'search' => 'Recherche',
            ],
        ],
        '500'=> [
            'title' => '500.',
            'h2' => [
                'not-found' => '500 non trouvé',
                '500' => '500.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Accueil',
                        ],
                        'not-found' => '500 non trouvé',
                    ],
                ],
            ],
            'p' => [
                'dont' => "Nous sommes désolés, mais la page que vous recherchez n'existe pas.",
            ],
            'button' => [
                'search' => 'Recherche',
            ],
        ],
        '503' => [
            'title' => '503.',
        ],
        'link-expired' => [
            'title' => '403',
            'h2' => [
                'expired' => '403 lien expiré',
                '403' => '403.',
            ],
            'nav' => [
                'ul' => [
                    'li' => [
                        'link' => [
                            'home' => 'Accueil',
                        ],
                        'link-expired' => '403 lien expiré',
                    ],
                ],
            ],
            'p' => [
                'expired' => 'Lien expiré',
            ],
        ],
    ],
];
