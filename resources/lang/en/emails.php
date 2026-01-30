<?php

return [
    'views' => [
        'contact' => [
            'p' => [
                'name' => 'Name:',
                'email' => 'Email:',
                'subject' => 'Subject:',
                'message' => 'Message:',
            ],
            'thanks' => 'Thanks,',
            'team' => 'Team',
        ],
        'welcome' => [
            'hello' => 'Hello :name',
            'welcome-to' => 'Welcome to artolog!',
            'i-hope' => 'I hope you\'ll find the platform useful.',
            'dont-hesitate' => 'Please don\'t hesitate to contact me if you have questions or comments.',
        ],
        'emailTemplate' => [
            'title' => [
                'artolog' => 'Artolog',
            ],
        ],
        'footer' => [
            'copyright' => 'All rights reserved.',
        ],
        'notifications' => [
            'email' => [
                'regards' => 'Thank you',
                'subcopy' => 'If you\'re having trouble clicking the ":actionText" button, copy and paste the URL below into your web browser:',
            ],
        ],
        'inviteToJoinGroup' => [
            'hello' => 'Hello :name',
            'p' => [
                'invite-you' => ':name would like to invite you to artolog to add you to :group_name. Follow this link to create an account',
                'invite-group' => ':name would like to invite :group_name to artolog. Follow this link to create an account',
            ],
        ],
        'inviteToTransferExhibit' => [
            'hello' => 'Hello :name',
            'p' => [
                'invite-you' => ':name has some of your art documentation to send you. Log in or register to download, edit or publish it.',
            ],
        ],
        'notifyArtistOfExhibitTransfer' => [
            'hello' => 'Hello :name',
            'p' => [
                'transfer-you' => ':name has transferred an exhibition to you. You can edit, publish or delete it in your account.',
            ],
        ],
    ],
    'app' => [
        'name' => 'Artolog',
        'NotifyAdminForContactUs' => [
            'subject' => [
                'website' => 'artolog.ca: ',
            ],
        ],
        'WelcomeToNewMember' => [
            'subject' => [
                'welcome' => 'Welcome to Artolog',
            ],
        ],
        'VerifyEmail' => [
            'subject' => 'Verify Email Address',
            'greeting' => 'Hello!',
            'line' => [
                'please-click' => 'Please click the button below to verify your email address.',
                'not-create-account' => 'If you did not create an account, no further action is required.',
            ],
            'action' => [
                'verify-email' => 'Verify Email Address',
            ]
        ],
        'ResetPassword' => [
            'subject' => 'Reset Password Notification',
            'greeting' => 'Hello!',
            'line' => [
                'you-receive' => 'You are receiving this email because we received a password reset request for your account.',
                'link-expires' => 'This password reset link will expire in :count minutes.',
                'not-request' => 'If you did not request a password reset, no further action is required.',
            ],
            'action' => [
                'reset-password' => 'Reset Password',
            ]
        ],
        'InviteToTransferExhibit' => [
            'subject' => 'Art documentation assist',
            'action-text' => 'Accept',
        ],
        'inviteToJoinGroup' => [
            'subject' => 'Invitation',
            'action-text' => 'Join me',
        ],
        'notifyArtistOfExhibitTransfer' => [
            'subject' => 'Transfer of the exhibit',
            'action-text' => 'Log In',
        ],
    ],
];
