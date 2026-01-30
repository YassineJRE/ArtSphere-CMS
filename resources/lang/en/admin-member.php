<?php

return [
    'views' => [
        'create' => [
            'title' => 'Create Member',
            'breadcrumbs' => [
                'home' => 'Home',
                'members' => 'Members',
                'new-member' => 'New Member',
            ],
            'label' => [
                'first-name' => 'First Name',
                'last-name' => 'Last Name',
                'email' => 'Email',
                'password' => 'Password',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'datatable-actions' => [
            'button' => [
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
            'paragraph' => [
                'sure' => 'Are you sure?',
            ],
            'h3' => [
                'delete-member' => 'Delete Member',
            ],
        ],
        'edit' => [
            'title' => 'Edit Member',
            'breadcrumbs' => [
                'home' => 'Home',
                'members' => 'Members',
            ],
            'label' => [
                'first-name' => 'First Name',
                'last-name' => 'Last  Name',
                'email' => 'Email',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'index' => [
            'title' => 'Members',
            'breadcrumbs' => [
                'home' => 'Home',
                'members' => 'Members',
            ],
            'button' => [
                'new' => 'Create New Member',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'first-name' => 'First Name',
                            'last-name' => 'Last Name',
                            'email' => 'Email',
                            'username' => 'Username',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Home',
                'members' => 'Members',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'member-created' => 'Member created successfully.',
            'member-updated' => 'Member updated successfully.',
            'member-deleted' => 'Member deleted successfully.',
        ],
    ],
];
