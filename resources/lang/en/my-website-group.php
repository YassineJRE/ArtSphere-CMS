<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-profile' => 'My Artist Profile',
                'artist-group' => 'My Artist Group',
                'my-websites' => 'My Website Group',
            ],
            'page-title' => [
                'my-websites' => 'My Website Groups',
            ],
            'breadcrumbs' => [
                'my-websites' => 'My Website Groups',
                'my-website-groups' => 'My Website Groups',
            ],
            'span' => [
                'add-website' => 'Create a Folder',
                'add-folder' => 'Create a folder to organize and add your web links. Add your favorite artists\' websites, your sales websites, etc.',
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
                            'delete-website' => 'Delete Website Group',
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
                'add-website' => 'Create a Folder',
            ],
            'page-title' => [
                'add-website' => 'Create a Folder',
            ],
            'breadcrumbs' => [
                'my-websites' => 'My Website Groups',
                'my-website-groups' => 'My Website Groups',
                'add-website' => 'Create a Folder',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Title:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'specify' => 'Specify:',
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
                'my-websites' => 'My Website Groups',
                'my-website-group' => 'My Website Groups',
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
            'breadcrumbs' => [
                'my-websites' => 'My Website Groups',
                'my-website-groups' => 'My Website Groups',
            ],
            'content' => [
                'back' => 'Back to My Website Groups',
            ],
            'edit-content' => 'Edit content',
            'span' => [
                'add-website' => 'Add Website',
            ],
            'footer' => [
                'name' => 'Name:',
                'description' => 'Description:',
                'type' => 'Type:',
                'button' => [
                    'edit' => 'Edit',
                    'unpublish' => 'Unpublish',
                    'publish' => 'Publish',
                    'delete' => 'Delete',
                    'another-website' => 'Create another Folder',
                    'view' => 'View',
                ],
                'title' => 'Title:',
                'owner' => 'Owners:',
                'status' => 'Status:',
                'additional-information-title' => 'Add a Title',
                'additional-information-content' => 'Add Additional Information:',
                'h3' => [
                    'delete' => 'Delete Website Group',
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
            'ul' => [
                'li' => [
                    'button' => [
                        'edit' => 'Edit',
                        'download' => 'Download',
                        'delete' => 'Delete',
                        'h3' => [
                            'delete-website' => 'Delete Website',
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
    ],
    'message' => [
        'success' => [
            'website-group-created' => 'Website Group created successfully.',
            'website-group-updated' => 'Website Group updated successfully.',
            'website-group-deleted' => 'Website Group deleted successfully.',
            'website-group-enabled' => 'Website Group activated successfully.',
            'website-group-disabled' => 'Website Group disabled successfully.',
        ],
    ],
];
