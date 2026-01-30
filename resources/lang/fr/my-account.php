<?php

return [
    'views' => [
        'index' => [
            'title' => 'Mon compte',
            'page-title' => 'Détails du compte',
            'breadcrumbs' => [
                'account' => 'Mon compte',
                'details' => 'Détails',
            ],
            'h3' => [
                'title' => 'Détails du compte',
            ],
            'address-section' => [
                'pronoun' => 'Pronom:',
                'first-name' => 'Prénom:',
                'last-name' => 'Nom:',
                'address' => 'Adresse:',
                'city' => 'Ville:',
                'country' => 'Pays:',
                'ethnicity' => 'Identité culturelle:',
                'email' => 'Adresse e-mail:',
                'password' => 'Mot de passe:',
            ],
            'button' => [
                'edit' => 'Modifier le compte',
                'change-password' => 'Changer le mot de passe',
            ],
        ],
        'change-password' => [
            'title' => 'Mon compte',
            'page-title' => 'Changer le mot de passe',
            'breadcrumbs' => [
                'account' => 'Mon compte',
                'change-password' => 'Changer le mot de passe',
            ],
            'form' => [
                'h3' => [
                    'title' => 'Changer le mot de passe:',
                ],
                'p' => [
                    'label' => [
                        'current-password' => 'Mot de passe actuel:',
                        'password' => 'Nouveau mot de passe:',
                        'password-confirmation' => 'Confirmation du nouveau mot de passe:',
                    ],
                    'value' => [
                        'save-button' => 'Changer le mot de passe',
                    ],
                ],
            ],
        ],
        'edit' => [
            'title' => 'Mon compte',
            'page-title' => 'Modifier le compte',
            'breadcrumbs' => [
                'account' => 'Mon compte',
                'edit-account' => 'Modifier',
            ],
            'form' => [
                'h3' => [
                    'title' => 'Détails du compte:',
                ],
                'p' => [
                    'label' => [
                        'avatar' => 'Avatar:',
                        'pronoun' => 'Pronom:',
                        'choose-file' => 'Choisir un fichier',
                        'first-name' => 'Prénom:',
                        'last-name' => 'Nom:',
                        'address' => 'Adresse:',
                        'city' => 'Ville:',
                        'country' => 'Pays:',
                        'ethnicity' => 'Identité culturelle:',
                        'email' => 'Adresse e-mail:',
                    ],
                    'value' => [
                        'save-button' => 'Sauvegarder',
                    ],
                ],
                'button' => [
                    'remove-file' => 'Effacer le fichier',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'my-account-updated' => 'Votre compte a été modifié avec succès.',
            'password-updated' => 'Votre mot de passe a été modifié avec succès.',
        ],
    ],
];
