<?php

return [
    'views' => [
        'create' => [
            'title' => 'Create Gallery',
            'breadcrumbs' => [
                'home' => 'Home',
                'galleries' => 'Galleries',
                'new-gallery' => 'New Gallery',
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
                'view' => 'View',
                'unpublish' => 'Unpublish',
                'publish' => 'Publish',
                'approve' => 'Approve',
            ],
            'paragraph' => [
                'sure' => 'Are you sure?',
            ],
            'h3' => [
                'delete-gallery' => 'Delete Gallery',
            ],
        ],
        'edit' => [
            'title' => 'Edit Gallery',
            'breadcrumbs' => [
                'home' => 'Home',
                'galleries' => 'Galleries',
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
            'title' => 'Galleries',
            'breadcrumbs' => [
                'home' => 'Home',
                'galleries' => 'Galleries',
            ],
            'button' => [
                'new' => 'Create New Gallery',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'name' => 'Name',
                            'institution-type' => 'Type of institution',
                            'actions' => 'Actions',
                            'status' => 'Status',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Home',
                'galleries' => 'Galleries',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'gallery-created' => 'Gallery created successfully.',
            'gallery-updated' => 'Gallery updated successfully.',
            'gallery-deleted' => 'Gallery deleted successfully.',
        ],
    ],
];
