<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-profile' => 'My Artist Profile',
                'artist-group' => 'My Artist Group',
                'my-model-removed' => 'My Removed Model',
            ],
            'page-title' => [
                'my-model-removed' => 'My Removed Models',
            ],
            'breadcrumbs' => [
                'my-model-removed' => 'My Removed Models',
            ],
            'span' => [
                'add-models' => 'Items you removed from the database. You can restore them if you change your mind.',
            ],
            'ul' => [
                'li' => [
                    'button' => [
                        'restore' => 'Restore',
                        'h3' => [
                            'restore-model' => 'Restore',
                        ],
                        'p' => [
                            'sure' => 'Are you sure ?',
                        ],
                        'form' => [
                            'button' => [
                                'restore' => 'Restore',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'model-removed-created' => 'Removed Model added successfully.',
            'model-removed-deleted' => 'Removed Model restored successfully.',
        ],
    ],
];
