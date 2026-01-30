<?php

return [
    'views' => [
        'notice' => [
            'title' => 'Verify email',
            'page-title' => 'Notice',
            'breadcrumbs' => [
                'notice' => 'Notice',
                'verify-email' => 'Verify email',
            ],
            'h2' => [
                'verify' => 'Verify email:',
            ],
            'p' => [
                'verification-message' => 'Please verify your email address by clicking the link in the mail we just sent you. Thanks!',
                'form' => [
                    'button' => [
                        'request' => 'Send a new link',
                    ],
                ],
            ],
        ],
        'profile-notice' => [
            'title' => 'Create your profile',
            'page-title' => 'Create your profile',
            'breadcrumbs' => [
                'home' => 'Home',
                'create-profile' => 'Create your profile',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'profile-type' => 'Profile Types:',
                        'text' => 'I am a',
                        'artist-name' => 'Artist Name:',
                        'other-artist-name' => 'Other Artist Name:',
                        'pronoun' => 'Pronoun:',
                        'first-name' => 'First Name:',
                        'last-name' => 'Last Name:',
                        'address' => 'Address:',
                        'city' => 'City:',
                        'country' => 'Country:',
                        'ethnicity' => 'Cultural Identity:',
                        'member-of' => 'Member of:',
                        'biography' => 'Biography:',
                        'specify' => 'Specify:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'artist-type' => 'Artist Type:',
                        'art-practice-type' => 'Art Practice Type:',
                        'artist' => 'Artist',
                        'curator' => 'Curator, gallery owner or event organizer',
                        'public-collector' => 'Public, collector, art admirer or art administrator',
                    ],
                    'text' => 'In order to create a <b>group</b>, <b>collective</b>, <b>artist center</b> or <b>an arts organization profile</b> you must first create one of the profiles above',
                    'button' => [
                        'save' => 'Save',
                        'create' => 'Create',
                    ],
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'verification-link' => 'Verification link sent to',
        ],
    ],
];
