<?php

return [
    'views' => [
        'create' => [
            'title' => 'Create Notification',
            'breadcrumbs' => [
                'home' => 'Home',
                'user-notifications' => 'Notifications',
                'new-user-notification' => 'New Notification',
            ],
            'label' => [
                'profile-id' => 'Profile ID',
                'ad-id' => 'Ad ID',
                'comment-id' => 'Comment ID',
                'review-id' => 'Review ID',
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
                'delete-user-notification' => 'Delete Notification',
            ],
        ],
        'edit' => [
            'title' => 'Edit Notification',
            'breadcrumbs' => [
                'home' => 'Home',
                'user-notifications' => 'Notifications',
            ],
            'label' => [
                'profile-id' => 'Profile ID',
                'ad-id' => 'Ad ID',
                'comment-id' => 'Comment ID',
                'review-id' => 'Review ID',
            ],
            'button' => [
                'save' => 'Save Changes',
            ],
        ],
        'index' => [
            'title' => 'Notifications',
            'breadcrumbs' => [
                'home' => 'Home',
                'user-notifications' => 'Notifications',
            ],
            'button' => [
                'new' => 'Create New Notification',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'user-id' => 'User ID',
                            'ad-id' => 'Ad ID',
                            'comment-id' => 'Comment ID',
                            'review-id' => 'Review ID',
                            'contact-id' => 'Contact ID',
                            'is-read' => 'Is Read',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => 'Show Notification',
            'breadcrumbs' => [
                'home' => 'Home',
                'user-notifications' => 'Notifications',
            ],
            'content' => [
                'id' => 'ID:',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'user-notification-created' => 'Notification created successfully.',
            'user-notification-updated' => 'Notification updated successfully.',
            'user-notification-deleted' => 'Notification deleted successfully.',
        ],
    ],
];
