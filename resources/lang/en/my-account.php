<?php

return [
    'views' => [
        'index' => [
            'title' => 'My account',
            'page-title' => 'Account details',
            'breadcrumbs' => [
                'account' => 'My account',
                'details' => 'Details',
            ],
            'h3' => [
                'title' => 'Account details',
            ],
            'address-section' => [
                'pronoun' => 'Pronoun:',
                'first-name' => 'First Name::',
                'last-name' => 'Last Name:',
                'address' => 'Address:',
                'city' => 'City:',
                'country' => 'Country:',
                'ethnicity' => 'Cultural Identity:',
                'email' => 'Email:',
                'password' => 'Password:',
            ],
            'button' => [
                'edit' => 'Edit account',
                'change-password' => 'Change password',
            ],
        ],
        'change-password' => [
            'title' => 'My account',
            'page-title' => 'Change password',
            'breadcrumbs' => [
                'account' => 'My account',
                'change-password' => 'Change password',
            ],
            'form' => [
                'h3' => [
                    'title' => 'Change password:',
                ],
                'p' => [
                    'label' => [
                        'current-password' => 'Current password:',
                        'password' => 'New password:',
                        'password-confirmation' => 'New password confirmation:',
                    ],
                    'value' => [
                        'save-button' => 'Change password',
                    ],
                ],
            ],
        ],
        'edit' => [
            'title' => 'My account',
            'page-title' => 'Edit Account',
            'breadcrumbs' => [
                'account' => 'My account',
                'edit-account' => 'Edit',
            ],
            'form' => [
                'h3' => [
                    'title' => 'Account details:',
                ],
                'p' => [
                    'label' => [
                        'avatar' => 'Avatar:',
                        'pronoun' => 'Pronoun:',
                        'choose-file' => 'Choose File',
                        'first-name' => 'First Name::',
                        'last-name' => 'Last Name:',
                        'address' => 'Address:',
                        'city' => 'City:',
                        'country' => 'Country:',
                        'ethnicity' => 'Cultural Identity:',
                        'email' => 'Email:',
                    ],
                    'value' => [
                        'save-button' => 'Save changes',
                    ],
                ],
                'button' => [
                    'remove-file' => 'Remove file',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'my-account-updated' => 'My Account updated successfully.',
            'password-updated' => 'Password updated successfully.',
        ],
    ],
];
