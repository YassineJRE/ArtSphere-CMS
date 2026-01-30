<?php

return [
    'views' => [
        'create' => [
            'title' => 'Create Review',
            'breadcrumbs' => [
                'home' => 'Home',
                'reviews' => 'Reviews',
                'new-review' => 'New Review',
            ],
            'label' => [
                'from' => 'From',
                'to' => 'To',
                'message' => 'Message',
                'is-positive' => 'Is Positive?',
                'processed' => 'Processed',
                'is-sent' => 'Is Sent',
                'is-read' => 'Is Read',
                'status' => 'Status',
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
                'delete-review' => 'Delete Review',
            ],
        ],
        'edit' => [
            'title' => 'Edit Review',
            'breadcrumbs' => [
                'home' => 'Home',
                'reviews' => 'Reviews',
            ],
            'label' => [
                'from' => 'From',
                'to' => 'To',
                'message' => 'Message',
                'is-positive' => 'Is Positive?',
                'processed' => 'Processed',
                'is-sent' => 'Is Sent',
                'is-read' => 'Is Read',
                'status' => 'Status',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'index' => [
            'title' => 'Reviews',
            'breadcrumbs' => [
                'home' => 'Home',
                'reviews' => 'Reviews',
            ],
            'button' => [
                'new' => 'Create New Review',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'from' => 'From',
                            'to' => 'To',
                            'ad-id' => 'Ad ID',
                            'message' => 'Message',
                            'is-positive' => 'Is Positive?',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => 'Show Review',
            'breadcrumbs' => [
                'home' => 'Home',
                'reviews' => 'Reviews',
            ],
            'content' => [
                'id' => 'ID:',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'review-created' => 'Review created successfully.',
            'review-updated' => 'Review updated successfully.',
            'review-deleted' => 'Review deleted successfully.',
        ],
    ],
];
