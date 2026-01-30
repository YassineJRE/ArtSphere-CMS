<?php

return [
    'views' => [
        'index' => [
            'title' => 'Register',
            'page-title' => 'Register',
            'breadcrumbs' => [
                'home' => 'Home',
                'register-breadcrumbs' => 'Register',
            ],
            'h2' => [
                'title' => 'Register:',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'first-name' => 'First Name:',
                        'last-name' => 'Last Name:',
                        'email' => 'Email address:',
                        'password' => 'Password:',
                        'password-confirmation' => 'Password Confirmation:',
                    ],
                    'account' => 'Have an account ?',
                    'login' => 'Log In',
                    'register-button' => 'Register',
                ],
            ],
            'p' => [
                'soft-roll-out' => 'You must be invited in order to register.',
            ],
        ],
        'finalize' => [
            'title' => 'Register',
            'page-title' => 'Register',
            'breadcrumbs' => [
                'home' => 'Home',
                'register-breadcrumbs' => 'Register',
            ],
            'h2' => [
                'title' => 'Register',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'first-name' => 'First Name:',
                        'last-name' => 'Last Name:',
                        'email' => 'Email address:',
                        'password' => 'Password:',
                        'password-confirmation' => 'Password Confirmation:',
                        'customer' => 'I am a customer',
                        'vendor' => 'I am a vendor',
                    ],
                    'register-button' => 'Register',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'register-successfully' => 'You have been registered successfully.',
        ],
        'error' => [
            'user-deleted' => 'This email cannot be used. Please contact the site administrator.',
        ]
    ],
];
