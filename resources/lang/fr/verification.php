<?php

return [
    'views' => [
        'notice' => [
            'title' => 'Vérification de l\'adresse e-mail',
            'page-title' => 'Notification',
            'breadcrumbs' => [
                'notice' => 'Notification',
                'verify-email' => 'Vérifier l\'adresse e-mail',
            ],
            'h2' => [
                'verify' => 'Vérifier l\'adresse e-mail:',
            ],
            'p' => [
                'verification-message' => 'Veuillez vérifier votre adresse e-mail en cliquant sur le lien dans le courriel que nous venons de vous envoyer. Merci!',
                'form' => [
                    'button' => [
                        'request' => 'Envoyer un nouveau lien',
                    ],
                ],
            ],
        ],
        'profile-notice' => [
            'title' => 'Créer votre profil',
            'page-title' => 'Créer votre profil',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'create-profile' => 'Créer votre profil',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'profile-type' => 'Types de profils:',
                        'text' => 'Je suis un',
                        'artist-name' => 'Nom d\'artiste:',
                        'other-artist-name' => 'Autre nom d\'artiste:',
                        'pronoun' => 'Pronom:',
                        'first-name' => 'Prénom:',
                        'last-name' => 'Nom:',
                        'address' => 'Adresse:',
                        'city' => 'Ville:',
                        'country' => 'Pays:',
                        'ethnicity' => 'Identité culturelle:',
                        'member-of' => 'Membre de:',
                        'biography' => 'Biographie:',
                        'specify' => 'Spécifier:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Ajouter des informations supplémentaires:',
                        'artist-type' => 'Type d\'artiste:',
                        'art-practice-type' => 'Type de pratique artistique:',
                        'artist' => 'Artiste',
                        'curator' => 'Commissaire, galeriste ou organisat.rice.eur d\'événements',
                        'public-collector' => 'Public, collectionneu.se.r, admirat.rice.eur d\'art ou administrat.rice.eur artistique',
                    ],
                    'text' => 'Afin de vous créer <b>un profil de groupe</b>, <b>collectif</b>, <b>centre d\'artistes</b> ou <b>organisme artistiques</b> vous devez premièrement vous créer un des profils ci-dessus',
                    'button' => [
                        'save' => 'Sauvegarder',
                        'create' => 'Créer',
                    ],
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'verification-link' => 'Lien de vérification envoyé à',
        ],
    ],
];
