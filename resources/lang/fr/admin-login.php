<?php

return [
    'views' => [
        'index' => [
            'title' => 'Connexion',
            'h3' => [
                'sign-in' => "S'identifier",
            ],
            'p' => [
                'label' => [
                    'email' => 'Courriel:',
                    'password' => 'Mot de passe:',
                ],
                'span' => [
                    'link' => [
                        'lost-password' => 'Mot de passe perdu ?',
                    ],
                ],
            ],
            'label' => [
                'remember-me' => 'Se souvenir de moi',
            ],
            'button' => [
                'log-in' => 'Se connecter',
            ],
        ],
    ],
    'message' => [
        'errors' => [
            'not-valid' => 'Les informations de connexion ne sont pas valides.',
        ],
        'success' => [
            'signed-in' => 'Connecté',
        ],
    ],
];
