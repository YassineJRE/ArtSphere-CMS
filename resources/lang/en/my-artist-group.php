<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'add-artist-group' => 'Artist Group',
            ],
            'page-title' => [
                'add-artist-group' => 'Artist Group',
            ],
            'breadcrumbs' => [
                'account' => 'My Account',
                'add-artist-group' => 'Artist Group',
            ],
            'p' => [
                'text' => 'Collective or group of artists with exhibits to present or artistic documentation to archive.',
                'button' => [
                    'create' => 'Create',
                ],
            ],
        ],
        'create' => [
            'title' => [
                'add-artist-group' => 'Create a Profile - Artist Group - Collective',
            ],
            'page-title' => [
                'add-artist-group' => 'Create a Profile - Artist Group - Collective:',
            ],
            'breadcrumbs' => [
                'my-account' => 'My account',
                'add-artist-group' => 'Create a Profile - Artist Group - Collective',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'group-name' => 'Group - Collective Name:',
                        'address' => 'Address:',
                        'city' => 'City:',
                        'country' => 'Country:',
                        'member-of' => 'Member of:',
                        'biography' => 'Biography:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'art-practice-type' => 'Art practice type:',
                        'specify' => 'Specify:',
                        'status' => 'Status:',
                    ],
                    'button' => [
                        'create' => 'Create',
                    ],
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-artist-groups' => 'My artist-groups',
                'edit' => 'Edit',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'group-name' => 'Group - Collective Name:',
                        'address' => 'Address:',
                        'city' => 'City:',
                        'country' => 'Country:',
                        'member-of' => 'Member of:',
                        'biography' => 'Biography:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'art-practice-type' => 'Art practice type:',
                        'specify' => 'Specify:',
                        'status' => 'Status:',
                    ],
                    'button' => [
                        'save' => 'Save',
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => [
                'my-artist-group' => 'My Artist Group',
            ],
            'breadcrumbs' => [
                'my-artist-groups' => 'My Artist Group',
            ],
            'p' => [
                'add-exhibit' => 'Add your exhibits, websites and manage all of your account information',
                'make-account-private' => 'Make your account private or available to the public',
                'delete-the-account' => 'Delete the account and all of it\'s content. If you are an administrator, you can transfer the account otherwise you will have to remove the group members first.',
                'sure' => 'Are you sure ?',
                'button' => [
                    'go-to-account' => 'Go to My Account',
                    'unpublish' => 'Unpublish',
                    'publish' => 'Publish',
                    'delete-account' => 'Delete Account',
                ],
            ],
            'h3' => [
                'delete-group' => 'Delete artist group',
            ],
            'form' => [
                'button' => [
                    'delete' => 'Delete',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'artist-group-created' => 'Artist Group created successfully.',
            'artist-group-updated' => 'Artist Group updated successfully.',
            'artist-group-deleted' => 'Artist Group deleted successfully.',
            'artist-group-enabled' => 'Artist Group activated successfully.',
            'artist-group-disabled' => 'Artist Group disabled successfully.',
        ],
    ],
];
