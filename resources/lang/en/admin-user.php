<?php

return [
    'views' => [
        'create' => [
            'title' => 'Users',
            'breadcrumbs' => [
                'home' => 'Home',
                'users' => 'Users',
                'new-user' => 'New User',
            ],
            'label' => [
                'first-name' => 'First Name',
                'last-name' => 'Last Name',
                'email' => 'Email',
                'roles' => 'Roles',
                'can-access-admin' => [
                    'question' => 'Can Access Admin ?',
                    'yes' => 'Yes',
                ],
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'datatable-actions' => [
            'button' => [
                'edit' => 'Edit',
                'delete' => 'Delete',
                'destroy' => 'Destroy',
                'link' => 'Send Activate Link',
                'restore' => 'Restore',
            ],
            'paragraph' => [
                'sure' => 'Are you sure?',
            ],
            'h3' => [
                'delete-user' => 'Delete User',
                'destroy-user' => 'Destroy User',
            ],
        ],
        'edit' => [
            'title' => 'Users',
            'breadcrumbs' => [
                'home' => 'Home',
                'users' => 'Users',
            ],
            'label' => [
                'first-name' => 'First Name',
                'last-name' => 'Last Name',
                'email' => 'Email',
                'roles' => 'Roles',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'index' => [
            'title' => 'Users',
            'breadcrumbs' => [
                'home' => 'Home',
                'users' => 'Users',
            ],
            'button' => [
                'new' => 'Create New User',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'first-name' => 'First Name',
                            'last-name' => 'Last Name',
                            'email' => 'Email',
                            'roles' => 'Roles',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Home',
                'users' => 'Users',
            ],
            'h4' => [
                'profile-details' => 'Profile Details',
                'roles' => "Roles",
                'recent-activities' => 'Recent Activities',
            ],
            'button' => [
                'edit' => 'Edit',
            ],
            'label' => [
                'first-name' => 'First Name',
                'last-name' => 'Last Name',
                'email' => 'Email',
                'username' => 'Username',
                'registered-at' => 'Registered At',
                'last-updated' => 'Last Updated',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'user-created' => 'User created successfully.',
            'user-updated' => 'User updated successfully.',
            'user-deleted' => 'User deleted successfully.',
        ],
    ],
];
