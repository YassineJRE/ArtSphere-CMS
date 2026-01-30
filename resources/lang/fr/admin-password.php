<?php

return [
    'views' => [
        'request' => [
            'title' => 'Mot de passe oublié',
            'h3' => [
                'forgot-password' => 'Mot de passe oublié ?',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'email' => 'Courriel:',
                    ],
                    'span' => [
                        'link' => [
                            'return' => 'Retour à la page de connexion',
                        ],
                    ],
                ],
                'button' => [
                    'reset-password' => 'Réinitialiser mon mot de passe',
                ],
            ],
        ],
        'reset' => [
            'title' => 'Réinitialiser le mot de passe',
            'h3' => [
                'reset-password' => 'Réinitialiser le mot de passe',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'email' => 'Courriel:',
                        'password' => 'Mot de passe:',
                        'confirm-password' => 'Confirmer le mot de passe:',
                    ],
                ],
                'button' => [
                    'reset-password' => 'Réinitialiser mon mot de passe',
                ],
            ],
        ],
    ],
];
