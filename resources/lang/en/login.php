<?php

return [
    'views' => [
        'index' => [
            'title' => 'Log In',
            'breadcrumbs' => [
                'home' => 'Home',
                'log-in' => 'Log In',
            ],
            'h2' => [
                'title' => 'Log In',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'email' => 'Email Address:',
                        'password' => 'Password:',
                        'span' => [
                            'remember' => 'Remember me',
                        ],
                    ],
                    'forgot-password' => 'Lost your password ?',
                    'no-account' => 'You don\'t have an account ?',
                    'sign-up' => 'Sign up',
                    'value' => [
                        'login-button' => 'Log In',
                    ],
                    'soft-roll-out' => 'We are still in the testing phase. If your email is in the invitation list; you can register. Contact us to register your interest: info@artologue.ca',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'signed-in' => 'Signed in.',
            'valid' => 'Login details are not valid.',
            'signed-out' => 'Signed out.',
        ],
    ],
];
