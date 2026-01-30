<?php

return [
    'views' => [
        'sidebar' => [
            'link' => [
                'title' => 'Navigation dans le tableau de bord'
            ],
            'ul' => [
                'submenu' => [
                    'main' => [
                        'title' => 'Principal',
                        'li' => [
                            'link' => [
                                'dashboard' => 'Tableau de bord',
                            ],
                        ],
                    ],
                    'listings' => [
                        'title' => 'Listes',
                        'li' => [
                            'link' => [
                                'trips' => 'Trajets',
                                'packages' => 'Colis',
                                'reviews' => 'Avis',
                                'add-trip' => 'Créer un trajet',
                                'members' => [
                                    'title' => 'Membres',
                                    'active' => 'Actifs',
                                    'pending' => 'En attente',
                                    'banned' => 'Bannis',
                                    'deleted' => 'Supprimés',
                                ],
                                'Galleries' => [
                                    'title' => 'Galeries',
                                    'active' => 'Actifs',
                                    'disabled' => 'En attente',
                                    'approved' => 'Approuvées',
                                    'awaiting-approval' => 'En attente d\'approbation',
                                    'all' => 'Toutes',
                                ],
                            ],
                        ],
                    ],
                    'system' => [
                        'title' => 'Système',
                        'li' => [
                            'link' => [
                                'user-notifications' => 'Notifications',
                                'logs' => [
                                    'title' => 'Connexions',
                                    'user-logs' => 'Utilisateurs',
                                    'admin-logs' => 'Administrateurs',
                                ],
                            ],
                            'contents' => 'Contenu',
                        ],
                    ],
                    'settings' => [
                        'li' => [
                            'link' => [
                                'search-criteria' => [
                                    'title' => 'Critères de recherche',
                                    'means-transport' => 'Moyens de Transport',
                                    'package-dimension' => 'Dimensions du colis',
                                    'available-space' => 'Espace disponible',
                                    'package-characteristics' => 'Caractéristiques du colis',
                                    'prohibited-products' => 'Produits interdits',
                                    'package-container' => 'Contenants',
                                    'package-type' => 'Types de colis',
                                    'meeting-place' => 'Lieux de rencontre',
                                    'delivery-location' => 'Lieux de livraison',
                                    'proximity' => 'Proximité',
                                    'unit' => 'Unité',
                                    'trip-status' => 'Statuts des trajets',
                                    'package-status' => 'Statuts des colis',
                                    'reservation-status' => 'Statuts des réservations',
                                    'refusal-reason' => 'Motifs de refus',
                                ],
                                'search-sorting' => [
                                    'title' => 'Tri des recherches',
                                    'search-packages-sorting' => 'Tri des recherches de paquets',
                                    'search-trips-sorting' => 'Tri des recherches de voyages',
                                    'search-reservations-sorting' => 'Tri des recherches de réservations',
                                ],
                            ],
                        ],
                    ],
                    'user-management' => [
                        'title' => 'Gestion des utilisateurs',
                        'li' => [
                            'link' => [
                                'users' => 'Utilisateurs',
                                'roles' => 'Rôles',
                            ],
                        ],
                    ],
                    'account' => [
                        'title' => 'Compte',
                        'li' => [
                            'link' => [
                                'my-profile' => 'Mon profil',
                                'logout' => 'Déconnexion',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'copyrights' => [
            'footer' => 'Listeo. Tous droits réservés.'
        ],
        'header' => [
            'my-account' => [
                'title' => 'Mon compte',
                'ul' => [
                    'li' => [
                        'link' => [
                            'my-profile' => 'Mon profil',
                            'logout' => 'Déconnexion',
                        ],
                    ],
                ],
            ],
            'link' => [
                'add-user' => 'Créer un utilisateur',
                'sign-in' => "S'identifier",
            ],
            'h3' => [
                'sign-in' => "S'identifier",
            ],
            'ul' => [
                'li' => [
                    'link' => [
                        'log-in' => 'Se connecter',
                        'register' => "S'inscrire",
                    ],
                ],
            ],
            'form' => [
                'label' => [
                    'username' => "Nom d'utilisateur",
                    'password' => 'Mot de passe:',
                    'remember-me' => 'Se souvenir de moi',
                    'email' => 'Courriel:',
                    'repeat-password' => 'Répéter le mot de passe:',
                ],
                'span' => [
                    'link' => [
                        'lost-your-password' => 'Mot de passe perdu ?',
                    ],
                ],
            ],
        ],
        'style-switcher' => [
            'h2' => [
                'color-switcher' => 'Sélecteur de couleur',
            ],
        ],
        'notifications' => [
            'p' => [
                'error-message' => '<strong>Erreur:</strong> S\'il vous plaît vérifier le formulaire ci-dessous pour les erreurs.',
                'success' => 'Succès:',
                'error' => 'Erreur:',
                'warning' => 'Attention:',
                'info' => 'Info:'
            ],
        ],
    ],
];
