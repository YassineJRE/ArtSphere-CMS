<?php

return [
    'views' => [
        'create' => [
            'title' => [
                'add-member' => 'Add a Member',
            ],
            'page-title' => [
                'add-member' => 'Add a Member',
            ],
            'breadcrumbs' => [
                'members' => 'Members',
                'add-member' => 'Add a Member',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'profile' => 'Profile:',
                        'role' => 'Role:',
                        'first-name' => 'First Name:',
                        'last-name' => 'Last Name:',
                        'email' => 'Email:',
                    ],
                    'button' => [
                        'save' => 'Save',
                        'send' => 'Send',
                        'add' => 'Add',
                    ],
                    'invitation-text' => 'If they\'re not in the system, you can invite them to artolog here:',
                ],
                'label' => [
                    'send-copy' => 'Send me a copy',
                ],
            ],
            'h2' => [
                'invite' => 'Invite',
            ],
            'h3' => [
                'invite-preview' => 'Invite preview:',
            ],
            'p' => [
                'hello' => 'Hello',
                'thank' => 'Thank you!',
                'text' => ':inviter would like to invite you to artolog to add you to :group_name. Follow this link to create an account',
                'artolog' => 'artolog',
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'members' => 'Members',
                'to-edit' => 'Edit',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'role' => 'Role:',
                    ],
                    'button' => [
                        'save' => 'Save',
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'members' => 'Members',
            ],
            'content' => [
                'back' => 'Back to Members',
            ],
            'edit-document' => 'Edit document',
            'footer' => [
                'name' => 'Name:',
                'role' => 'Role:',
                'artist-name' => 'Artist name:',
                'biography' => 'Biography:',
                'description' => 'Description:',
                'button' => [
                    'edit' => 'Edit',
                    'delete' => 'Delete',
                ],
                'h3' => [
                    'delete-member' => 'Delete Member',
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
        'index' => [
            'title' => [
                'artist-group' => 'Artist group',
            ],
            'breadcrumbs' => [
                'members' => 'Members',
            ],
            'button' => [
                'span' => [
                    'add-member' => 'Add a Member',
                ],
            ],
            'ul' => [
                'li' => [
                    'administrator' => 'Administrator',
                    'member' => 'Visitor',
                    'pending-approval' => 'Pending approval',
                    'saved' => 'Saved',
                    'pending' => 'Pending',
                    'button' => [
                        'resend-invitation' => 'Resend Invitation',
                        'edit' => 'Edit',
                        'remove' => 'Remove',
                        'delete' => 'Delete',
                    ],
                    'h3' => [
                        'remove-member' => 'Remove Member',
                        'delete-invitation' => 'Delete Invitation',
                    ],
                    'p' => [
                        'sure' => 'Are you sure ?',
                    ],
                    'form' => [
                        'button' => [
                            'remove' => 'Remove',
                            'delete' => 'Delete',
                        ],
                    ],
                ],
            ],
            'h3' => [
                'invitations' => 'Invitations',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'member-added' => 'Member created successfully.',
            'member-updated' => 'Member role updated successfully.',
            'member-removed' => 'Member deleted successfully.',
            'member-enabled' => 'Member activated successfully.',
            'member-disabled' => 'Member disabled successfully.',
            'invitation-sent' => 'Invitation sent.',
        ],
        'error' => [
            'email-sending-failed' => 'Email sending failed.',
        ],
    ],
];
