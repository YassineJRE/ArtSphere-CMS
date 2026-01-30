<?php

return [
    'views' => [
        'request' => [
            'title' => 'Forgot Password',
            'h3' => [
                'forgot-password' => 'Forgot Your Password?',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'email' => 'Email:',
                    ],
                    'span' => [
                        'link' => [
                            'return' => 'Return To Login Page',
                        ],
                    ],
                ],
                'button' => [
                    'reset-password' => 'Reset My Password',
                ],
            ],
        ],
        'reset' => [
            'title' => 'Reset Password',
            'h3' => [
                'reset-password' => 'Reset Password',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'email' => 'Email:',
                        'password' => 'Password:',
                        'confirm-password' => 'Confirm Password:',
                    ],
                ],
                'button' => [
                    'reset-password' => 'Reset My Password',
                ],
            ],
        ],
    ],
];
