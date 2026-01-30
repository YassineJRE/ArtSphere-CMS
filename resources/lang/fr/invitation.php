<?php

return [
    'views' => [
        'registration' => [
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
        ],
    ],
    'message' => [
        'success' => [
            'register-successfully' => 'Vous avez été enregistré avec succès.',
        ],
    ],
];
