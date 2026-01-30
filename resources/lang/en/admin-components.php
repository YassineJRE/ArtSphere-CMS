<?php

return [
    'views' => [
        'sidebar' => [
            'link' => [
                'title' => 'Dashboard Navigation'
            ],
            'ul' => [
                'submenu' => [
                    'main' => [
                        'title' => 'Main',
                        'li' => [
                            'link' => [
                                'dashboard' => 'Dashboard',
                            ],
                        ],
                    ],
                    'listings' => [
                        'title' => 'Listings',
                        'li' => [
                            'link' => [
                                'trips' => 'Trips',
                                'packages' => 'Packages',
                                'reviews' => 'Reviews',
                                'add-trip' => 'Add Trip',
                                'members' => [
                                    'title' => 'Members',
                                    'active' => 'Active',
                                    'pending' => 'Pending',
                                    'banned' => 'Banned',
                                    'deleted' => 'Deleted',
                                ],
                                'galleries' => [
                                    'title' => 'Galleries',
                                    'active' => 'Active',
                                    'disabled' => 'Pending',
                                    'approved' => 'Approved',
                                    'awaiting-approval' => 'Awaiting approval',
                                    'all' => 'All',
                                ],
                            ],
                        ],
                    ],
                    'system' => [
                        'title' => 'System',
                        'li' => [
                            'link' => [
                                'user-notifications' => 'Notifications',
                                'logs' => [
                                    'title' => 'Logs',
                                    'user-logs' => 'Users',
                                    'admin-logs' => 'Admins',
                                ],
                            ],
                            'contents' => 'Contents',
                        ],
                    ],
                    'settings' => [
                        'li' => [
                            'link' => [
                                'search-criteria' => [
                                    'title' => 'Search Criteria',
                                    'means-transport' => 'Means Transport',
                                    'package-dimension' => 'Package Dimension',
                                    'available-space' => 'Available Space',
                                    'package-characteristics' => 'Package Characteristics',
                                    'prohibited-products' => 'Prohibited Products',
                                    'package-container' => 'Package Container',
                                    'package-type' => 'Package Type',
                                    'meeting-place' => 'Meeting Place',
                                    'delivery-location' => 'Delivery Location',
                                    'proximity' => 'Proximity',
                                    'unit' => 'Unit',
                                    'trip-status' => 'Trip Status',
                                    'package-status' => 'Package Status',
                                    'reservation-status' => 'Reservation Status',
                                    'refusal-reason' => 'Refusal Reasons',
                                ],
                                'search-sorting' => [
                                    'title' => 'Search Sorting',
                                    'search-packages-sorting' => 'Search Packages Sorting',
                                    'search-trips-sorting' => 'Search Trips Sorting',
                                    'search-reservations-sorting' => 'Search Reservations Sorting',
                                ],
                            ],
                        ],
                    ],
                    'user-management' => [
                        'title' => 'User Management',
                        'li' => [
                            'link' => [
                                'users' => 'Users',
                                'roles' => 'Roles',
                            ],
                        ],
                    ],
                    'account' => [
                        'title' => 'Account',
                        'li' => [
                            'link' => [
                                'my-profile' => 'My Profile',
                                'logout' => 'Logout',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'copyrights' => [
            'footer' => 'Listeo. All Rights Reserved.'
        ],
        'header' => [
            'my-account' => [
                'title' => 'My Account',
                'ul' => [
                    'li' => [
                        'link' => [
                            'my-profile' => 'My Profile',
                            'logout' => 'Logout',
                        ],
                    ],
                ],
            ],
            'link' => [
                'add-user' => 'Add User',
                'sign-in' => 'Sign In',
            ],
            'h3' => [
                'sign-in' => 'Sign In',
            ],
            'ul' => [
                'li' => [
                    'link' => [
                        'log-in' => 'Log In',
                        'register' => 'Register',
                    ],
                ],
            ],
            'form' => [
                'label' => [
                    'username' => 'Username:',
                    'password' => 'Password:',
                    'remember-me' => 'Remember Me',
                    'email' => 'Email:',
                    'repeat-password' => 'Repeat Password:',
                ],
                'span' => [
                    'link' => [
                        'lost-your-password' => 'Lost Your Password ?',
                    ],
                ],
            ],
        ],
        'style-switcher' => [
            'h2' => [
                'color-switcher' => 'Color Switcher',
            ],
        ],
        'notifications' => [
            'p' => [
                'error-message' => '<strong>Error:</strong> Please check the form below for errors.',
                'success' => 'Success:',
                'error' => 'Error:',
                'warning' => 'Warning:',
                'info' => 'Info:'
            ],
        ],
    ],
];
