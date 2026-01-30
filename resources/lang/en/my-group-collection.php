<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-group' => 'My Artist Profile',
                'my-collections' => 'My Collection',
            ],
            'page-title' => [
                'my-collections' => 'My Collections',
            ],
            'breadcrumbs' => [
                'my-collections' => 'My Collections',
            ],
            'span' => [
                'add-collection' => 'Create a Folder',
            ],
            'ul' => [
                'li' => [
                    'edit' => 'Edit',
                    'span' => [
                        'published' => 'Published',
                        'unpublished' => 'Unpublished',
                    ],
                    'button' => [
                        'unpublish' => 'Unpublish',
                        'publish' => 'Publish',
                        'delete' => 'Delete',
                        'h3' => [
                            'delete-collection' => 'Delete Collection',
                        ],
                        'p' => [
                            'sure' => 'Are you sure ?',
                        ],
                        'form' => [
                            'button' => [
                                'delete' => 'Delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'create' => [
            'title' => [
                'add-collection' => 'Create a Folder',
            ],
            'page-title' => [
                'add-collection' => 'Create a Folder',
            ],
            'breadcrumbs' => [
                'my-collections' => 'My Collections',
                'add-collection' => 'Create a Folder',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Title:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'status' => 'Status:',
                    ],
                    'button' => [
                        'save' => 'Save',
                    ],
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-collections' => 'My Collections',
                'to-edit' => 'Edit',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Title:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'status' => 'Status:',
                    ],
                    'button' => [
                        'save' => 'Save',
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'my-collections' => 'My Collections',
            ],
            'content' => [
                'back' => 'Back to My collections',
            ],
            'edit-content' => 'Edit content',
            'footer' => [
                'title' => 'Title:',
                'description' => 'Description:',
                'status' => 'Status:',
                'additional-information-title' => 'Add a Title',
                'additional-information-content' => 'Add Additional Information:',
                'published' => 'Published',
                'unpublished' => 'Unpublished',
                'button' => [
                    'edit' => 'Edit',
                    'unpublish' => 'Unpublish',
                    'publish' => 'Publish',
                    'delete' => 'Delete',
                    'another-collection' => 'Add another Collection',
                ],
                'h3' => [
                    'delete' => 'Delete Collection',
                ],
                'p' => [
                    'sure' => 'Are you sure ?',
                ],
                'form' => [
                    'button' => [
                        'delete' => 'Delete',
                    ],
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'collection-created' => 'Collection created successfully.',
            'collection-updated' => 'Collection updated successfully.',
            'collection-deleted' => 'Collection deleted successfully.',
            'collection-enabled' => 'Collection activated successfully.',
            'collection-disabled' => 'Collection disabled successfully.',
        ],
    ],
];
