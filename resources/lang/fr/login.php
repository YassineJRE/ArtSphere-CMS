<?php

return [
    'views' => [
        'index' => [
            'title' => 'Connexion',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'log-in' => 'Connexion',
            ],
            'h2' => [
                'title' => 'Connexion',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'email' => 'Adresse e-mail:',
                        'password' => 'Mot de passe:',
                        'span' => [
                            'remember' => 'Se souvenir de moi',
                        ],
                    ],
                    'forgot-password' => 'Mot de passe oublié ?',
                    'no-account' => 'Vous n\'avez pas de compte ?',
                    'sign-up' => 'Inscrivez-vous',
                    'value' => [
                        'login-button' => 'Se connecter',
                    ],
                    'soft-roll-out' => 'Nous sommes encore dans la phase d\'essais. Si votre courriel figure dans la liste d\'invitation; vous pouvez vous inscrire. Contactez nous pour signaler votre intérêt: info@artologue.ca',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'signed-in' => 'Connecté.',
            'valid' => 'Les informations de connexion ne sont pas valides.',
            'signed-out' => 'Déconnecté.',
        ],
    ],
];
