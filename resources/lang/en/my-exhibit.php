<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-profile' => 'My Artist Profile',
                'artist-group' => 'My Artist Group',
                'my-exhibits' => 'My Exhibit',
            ],
            'page-title' => [
                'my-exhibits' => 'My Exhibits',
            ],
            'breadcrumbs' => [
                'my-exhibits' => 'My Exhibits',
            ],
            'span' => [
                'add-exhibit' => 'Add an Exhibit',
                'add-documentation' => 'Add your art documentation, photos, links to your videos, etc.',
                'add-documentation-and-transfer' => 'Add art documentation to transfer to artists',
            ],
            'ul' => [
                'li' => [
                    'edit' => 'Edit',
                    'download' => 'Download',
                    'span' => [
                        'published' => 'Published',
                        'unpublished' => 'Unpublished',
                    ],
                    'button' => [
                        'unpublish' => 'Unpublish',
                        'publish' => 'Publish',
                        'delete' => 'Delete',
                        'h3' => [
                            'delete-exhibit' => 'Delete Exhibit',
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
                'add-exhibit' => 'Add an Exhibit',
            ],
            'page-title' => [
                'add-exhibit' => 'Add an Exhibit',
            ],
            'breadcrumbs' => [
                'my-exhibits' => 'My Exhibits',
                'add-exhibit' => 'Add an Exhibit',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'exhibit-name' => 'Exhibit Name:',
                        'type' => 'Type:',
                        'description' => 'Description:',
                        'description-text' => 'Dates, grant acknowledgements and other information will be taken from the information provided when adding the works.',
                        'location' => 'Indicate the location where this exhibition will take place: (If applicable)',
                        'gallery' => 'Select the gallery for this exhibit (required for verification):',
                        'upcoming-date' => 'Indicate the planned date of this exhibition:',
                        'open-at' => 'Indicate the date and time of the opening:',
                        'thanks' => 'Special Thanks:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'status' => 'Status:',
                    ],
                    'button' => [
                        'save' => 'Save',
                        'transfer' => 'Send',
                    ],
                    'transfer-text' => 'You cannot publish exhibits but you can transfer it to the artist owner. It will be added to your collection.'
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-exhibits' => 'My Exhibits',
                'to-edit' => 'Edit',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'exhibit-name' => 'Exhibit Name:',
                        'type' => 'Type:',
                        'description' => 'Description:',
                        'description-text' => 'Dates, grant acknowledgements and other information will be taken from the information provided when adding the works.',
                        'location' => 'Indicate the location where this exhibition will take place: (If applicable)',
                        'upcoming-date' => 'Indicate the planned date of this exhibition:',
                        'open-at' => 'Indicate the date and time of the opening:',
                        'thanks' => 'Special Thanks:',
                        'additional-information-title' => 'Add a Title',
                        'additional-information-content' => 'Add Additional Information:',
                        'status' => 'Status:',
                    ],
                    'button' => [
                        'save' => 'Save',
                        'transfer' => 'Send',
                    ],
                    'verified-reset-warning'=>'Warning! If you change the Name, Type, Location or Gallery the verification of this exhibit will be reset!',
                    'transfer-text' => 'You cannot publish exhibits but you can transfer it to the artist owner. It will be added to your collection.'
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'my-exhibits' => 'My Exhibits',
            ],
            'content' => [
                'back' => 'Back to My Exhibits',
            ],
            'edit-content' => 'Edit content',
            'h2' => [
                'artworks' => 'Artworks',
            ],
            'span' => [
                'add-artwork' => 'Add Artwork',
            ],
            'ul' => [
                'li' => [
                    'button' => [
                        'edit' => 'Edit',
                        'download' => 'Download',
                        'delete' => 'Delete',
                        'transfer' => 'Transfer',
                        'h3' => [
                            'delete-artwork' => 'Delete Artwork',
                            'transfer-artwork' => 'Transfer Artwork',
                        ],
                        'p' => [
                            'sure' => 'Are you sure ?',
                            'choose-exhibit' => 'Choose Exhibit',
                        ],
                        'form' => [
                            'button' => [
                                'delete' => 'Delete',
                                'transfer' => 'Transfer',
                            ],
                        ],
                    ],
                    'span' => [
                        'add-upcoming' => 'Add upcoming Gallery or-and location',
                    ],
                ],
            ],
            'footer' => [
                'name' => 'Name:',
                'description' => 'Description:',
                'location' => 'Location(s):',
                'gallery' => 'Gallery:',
                'verification' => 'Verification Status:',
                'dates' => 'Dates:',
                'special-thanks' => 'Special thanks:',
                'additional-information-title' => 'Add a Title',
                'grant-acknowledgement' => 'Grant acknowledgement:',
                'type' => 'Type:',
                'upcoming-date' => 'Upcoming exhibition:',
                'open-date' => 'Open Date:',
                'open-time' => 'Open Time:',
                'additional-information-content' => 'Add Additional Information:',
                'button' => [
                    'edit' => 'Edit',
                    'unpublish' => 'Unpublish',
                    'publish' => 'Publish',
                    'delete' => 'Delete',
                    'another-exhibit' => 'Add another Exhibit',
                    'transfer' => 'Send',
                    'resend-invitation-mail' => 'Resend invitation mail',
                    'view' => 'View',
                ],
                'a' => [
                    'advanced'=> 'Download Options',
                ],
                'label' => [
                    'filetype' => 'Choose a document type:',
                    'artworks' => 'Choose artworks for download:',
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
        'transfer-to' => [
            'title' => [
                'transfer-to-artist' => 'Transfer to an artist',
            ],
            'page-title' => [
                'transfer-to-artist' => 'Transfer to an artist',
            ],
            'breadcrumbs' => [
                'my-exhibits' => 'My Exhibits',
                'transfer-to-artist' => 'Transfer to an artist',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'profile' => 'Profile:',
                        'type' => 'Type:',
                        'text-invite' => 'If they\'re not in the system, you can invite them to artolog here:',
                        'first-name' => 'First Name:',
                        'last-name' => 'Last Name:',
                        'email' => 'Email:',
                    ],
                    'button' => [
                        'save' => 'Save',
                        'send' => 'Send',
                        'transfer' => 'Transfer',
                    ],
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
                'hi' => 'Hello',
                'text' => 'has some of your art documentation to send you. Log in or register to download, edit or publish it.',
                'thank' => 'Thank you,',
                'artolog' => 'artolog',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'exhibit-created' => 'Exhibit created successfully.',
            'exhibit-updated' => 'Exhibit updated successfully.',
            'exhibit-deleted' => 'Exhibit deleted successfully.',
            'exhibit-enabled' => 'Exhibit activated successfully.',
            'exhibit-disabled' => 'Exhibit disabled successfully.',
            'exhibit-has-been-transfered' => 'Exhibit has been transfered.',
            'exhibit-has-not-been-transfered' => 'Exhibit has not been transfered.',
            'invitation-sent' => 'Invitation sent.',
        ],
        'error' => [
            'email-sending-failed' => 'Email sending failed.',
        ],
    ],
];
