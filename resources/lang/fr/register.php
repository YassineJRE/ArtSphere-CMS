<?php

return [
    'views' => [
        'index' => [
            'title' => 'Inscription',
            'page-title' => 'Inscription',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'register-breadcrumbs' => 'Inscription',
            ],
            'h2' => [
                'title' => 'Inscription:',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'first-name' => 'Prénom:',
                        'last-name' => 'Nom:',
                        'email' => 'Adresse e-mail:',
                        'password' => 'Mot de passe:',
                        'password-confirmation' => 'Confirmation mot de passe:',
                    ],
                    'account' => 'Vous avez un compte ?',
                    'login' => 'Connectez-vous',
                    'register-button' => 'S\'inscrire',
                ],
            ],
            'p' => [
                'soft-roll-out' => 'Vous devez être invité afin de vous inscrire.',
            ],
        ],
        'finalize' => [
            'title' => 'Inscription',
            'page-title' => 'Inscription',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'register-breadcrumbs' => 'Inscription',
            ],
            'h2' => [
                'title' => 'Inscription',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'first-name' => 'Prénom:',
                        'last-name' => 'Nom:',
                        'email' => 'Adresse e-mail:',
                        'password' => 'Mot de passe:',
                        'password-confirmation' => 'Confirmation mot de passe:',
                        'customer' => 'Je suis client',
                        'vendor' => 'Je suis vendeur',
                    ],
                    'register-button' => 'S\'inscrire',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'register-successfully' => 'Vous avez été enregistré avec succès.',
        ],
        'error' => [
            'user-deleted' => 'Ce courriel ne peut pas être utilisé. Veuillez contacter l\'administrateur du site.',
        ]
    ],
];
