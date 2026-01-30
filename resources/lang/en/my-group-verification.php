<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-profile' => 'My Artist Profile',
                'artist-group' => 'My Artist Group',
                'verification' => 'Verify Exhibit',
            ],
            'page-title' => [
                'verification' => 'Verify Exhibit',
            ],
            'breadcrumbs' => [
                'verification' => 'Verify Exhibit',
            ],
        ],
        'list' =>[
            'span' =>[
                'no-exhibits' => 'All Clear! Come back later to verify more exhibits.',
                'not-verified' => 'This group is not yet verified. Please come back later to verify exhibits.',
                'status-pending' =>'This exhibit is pending verification, verify it?',
                'status-approved' =>'This exhibit is verified.',
                'status-denied' =>'This exhibit was denied verification.',
            ],
            'button' =>[
                'confirm-verification' =>'Confirm',
                'deny-verification'=>'Deny',
                'revoke-verification'=>'Revoke Verification',
                'restate-pending'=>'Restate Pending',
                'denial-to-verification'=>'Verify'
            ],
            'form' => [
                'filter' => [
                    'label'=>['select-filter'=>'Filter by'],
                    'button'=>['submit'=>'Apply'],
                    'option'=>[
                        'Approved' => 'Approved',
                        'Denied' => 'Denied',
                        'Pending' => 'Pending',
                        'all' => 'All',
                    ],
                ]
            ]
        ]
    ]
];
