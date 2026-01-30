<?php

return [
    'views' => [
        'contact' => [
            'p' => [
                'name' => 'Nom:',
                'email' => 'Courriel:',
                'subject' => 'Sujet:',
                'message' => 'Message:',
            ],
            'thanks' => 'Merci,',
            'team' => 'l\'équipe',
        ],
        'welcome' => [
            'hello' => 'Bonjour :name',
            'welcome-to' => 'Bienvenue sur artologue!',
            'i-hope' => 'J\'espère que vous trouverez la plateforme utile.',
            'dont-hesitate' => 'N\'hésitez pas à me contacter si vous avez des questions ou des commentaires.',
        ],
        'emailTemplate' => [
            'title' => [
                'artolog' => 'Artologue',
            ],
        ],
        'footer' => [
            'copyright' => 'Tous droits réservés',
        ],
        'notifications' => [
            'email' => [
                'regards' => 'Merci',
                'subcopy' => 'Si vous avez des difficultés à cliquer sur le bouton ":actionText", copiez et collez l\'URL ci-dessous dans votre navigateur Web:'
            ],
        ],
        'inviteToJoinGroup' => [
            'hello' => 'Salut :name',
            'p' => [
                'invite-you' => ':name aimerait vous inviter à artologue afin de vous ajouter à :group_name. Suivez ce lien pour vous créer un compte',
            ],
        ],
        'inviteToTransferExhibit' => [
            'hello' => 'Bonjour :name',
            'p' => [
                'invite-you' => ':name a de votre documentation artistique à vous envoyer. Connectez-vous ou inscrivez-vous pour la télécharger, la modifier ou la publier.',
            ],
        ],
        'notifyArtistOfExhibitTransfer' => [
            'hello' => 'Salut :name',
            'p' => [
                'transfer-you' => ':name vous a transféré une exposition. Vous pouvez la modifier, publier ou supprimer dans votre compte.',
            ],
        ],
    ],
    'app' => [
        'name' => 'artologue',
        'NotifyAdminForContactUs' => [
            'subject' => [
                'website' => 'artolog.ca: ',
            ],
        ],
        'WelcomeToNewMember' => [
            'subject' => [
                'welcome' => 'Bienvenue sur Artologue',
            ],
        ],
        'VerifyEmail' => [
            'subject' => 'Vérifier l\'adresse e-mail',
            'greeting' => 'Bonjour !',
            'line' => [
                'please-click' => 'Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.',
                'not-create-account' => 'Si vous n\'avez pas créé de compte, aucune autre action n\'est requise.',
            ],
            'action' => [
                'verify-email' => 'Vérifier l\'adresse e-mail',
            ]
        ],
        'ResetPassword' => [
            'subject' => 'Avis de réinitialisation du mot de passe',
            'greeting' => 'Bonjour !',
            'line' => [
                'you-receive' => ' Vous recevez ce courriel car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.',
                'link-expires' => 'Ce lien de réinitialisation du mot de passe expirera dans :count minutes.',
                'not-request' => 'Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune autre action n\'est requise.',
            ],
            'action' => [
                'reset-password' => 'Réinitialiser le mot de passe',
            ]
        ],
        'InviteToTransferExhibit' => [
            'subject' => 'Aide à la documentation artistique',
            'action-text' => 'Accepter',
        ],
        'inviteToJoinGroup' => [
            'subject' => 'Invitation',
            'action-text' => 'Rejoins-moi',
        ],
        'notifyArtistOfExhibitTransfer' => [
            'subject' => 'Transfert de l\'exposition',
            'action-text' => 'Se connecter',
        ],
    ],
];
