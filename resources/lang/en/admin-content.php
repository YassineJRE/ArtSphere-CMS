<?php

return [
    'views' => [
        'create' => [
            'title' => 'Create Content',
            'breadcrumbs' => [
                'home' => 'Home',
                'contents' => 'Contents',
                'new-content' => 'New Content',
            ],
            'label' => [
                'key' => 'Key',
                'type' => 'Type',
                'status' => 'Status',
                'content' => 'Content',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'datatable-actions' => [
            'button' => [
                'edit' => 'Edit',
                'delete' => 'Delete',
                'restore' => 'Restore',
            ],
            'paragraph' => [
                'sure' => 'Are you sure?',
            ],
            'h3' => [
                'delete-content' => 'Delete Content',
            ],
        ],
        'edit' => [
            'title' => 'Edit Content',
            'breadcrumbs' => [
                'home' => 'Home',
                'contents' => 'Contents',
            ],
            'label' => [
                'key' => 'Key',
                'type' => 'Type',
                'status' => 'Status',
                'content' => 'Content',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'index' => [
            'title' => 'Contents',
            'breadcrumbs' => [
                'home' => 'Home',
                'contents' => 'Contents',
            ],
            'button' => [
                'new' => 'Create New Content',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'key' => 'Key',
                            'type' => 'Type',
                            'content' => 'Content',
                            'status' => 'Status',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => 'Show Content',
            'breadcrumbs' => [
                'home' => 'Home',
                'contents' => 'Contents',
            ],
            'content' => [
                'id' => 'ID:',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'content-created' => 'Content created successfully.',
            'content-updated' => 'Content updated successfully.',
            'content-deleted' => 'Content deleted successfully.',
        ],
    ],
];
