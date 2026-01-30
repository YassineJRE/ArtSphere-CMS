<?php

return [
    'views' => [
        'create' => [
            'title' => [
                'add-document' => 'Add a Document',
            ],
            'page-title' => [
                'add-document' => 'Add a Document',
            ],
            'breadcrumbs' => [
                'my-documents' => 'My Documents',
                'add-document' => 'Add a Document',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'file' => 'File:',
                        'name' => 'Name:',
                        'description' => 'Description:',
                        'status' => 'Status:',
                        'choose-file' => 'Choose File',
                    ],
                    'button' => [
                        'save' => 'Save',
                    ],
                ],
                'button' => [
                    'remove-file' => 'Remove file',
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-documents' => 'My Documents',
                'to-edit' => 'Edit',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'file' => 'File:',
                        'name' => 'Name:',
                        'description' => 'Description:',
                        'status' => 'Status:',
                        'choose-file' => 'Choose File',
                    ],
                    'button' => [
                        'save' => 'Save',
                    ],
                ],
                'button' => [
                    'remove-file' => 'Remove file',
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'my-documents' => 'My Documents',
            ],
            'content' => [
                'back' => 'Back to My Documents',
            ],
            'edit-document' => 'Edit document',
            'footer' => [
                'name' => 'Name:',
                'description' => 'Description:',
                'status' => 'Status:',
                'published' => 'Published',
                'unpublished' => 'Unpublished',
                'button' => [
                    'edit' => 'Edit',
                    'unpublish' => 'Unpublish',
                    'publish' => 'Publish',
                    'download' => 'Download',
                    'delete' => 'Delete',
                    'another-document' => 'Add another Document',
                ],
                'h3' => [
                    'delete' => 'Delete Document',
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
            'document-created' => 'Document created successfully.',
            'document-updated' => 'Document updated successfully.',
            'document-deleted' => 'Document deleted successfully.',
            'document-enabled' => 'Document activated successfully.',
            'document-disabled' => 'Document disabled successfully.',
        ],
    ],
];
