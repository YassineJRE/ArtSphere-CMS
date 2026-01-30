<?php

return [
    'views' => [
        'create' => [
            'title' => 'Create New Role',
            'breadcrumbs' => [
                'home' => 'Home',
                'roles' => 'Roles',
                'new-role' => 'New Role',
            ],
            'label' => [
                'name' => 'Name',
                'permission' => 'Permission',
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
                'delete-role' => 'Delete Role',
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'home' => 'Home',
                'roles' => 'Roles',
            ],
            'label' => [
                'name' => 'Name',
                'permission' => 'Permission',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'index' => [
            'title' => 'Roles',
            'breadcrumbs' => [
                'home' => 'Home',
                'roles' => 'Roles',
            ],
            'button' => [
                'new' => 'Create New Role',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'name' => 'Name',
                            'guard-name' => 'Guard Name',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Home',
                'roles' => 'Roles',
            ],
            'h2' => [
                'name' => 'Name',
                'guard-name' => 'Guard Name',
                'permission' => 'Permissions',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'role-created' => 'Role created successfully.',
            'role-updated' => 'Role updated successfully.',
            'role-deleted' => 'Role deleted successfully.',
        ],
    ],
];
