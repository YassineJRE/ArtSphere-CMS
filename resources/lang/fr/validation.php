<?php

use App\Enums\Status;
use App\Enums\ArtistType;
use App\Enums\ArtPracticeType;
use App\Enums\ProfileType;
use App\Enums\InstitutionType;
use App\Enums\GroupType;
use App\Enums\ExhibitType;
use App\Enums\MemberType;
use App\Enums\WebsiteGroupType;

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'Le champ :attribute n\'est pas une URL valide.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute must have between :min and :max items.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute must be between :min and :max.',
        'string' => 'The :attribute must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'La confirmation du :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Le champ :attribute doit être une adresse e-mail valide.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'Le :attribute sélectionné(e) est incorrect(e)',
    'file' => 'Le champ :attribute doit être un fichier.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'image' => 'Le champ :attribute doit être une image.',
    'in' => 'Le :attribute sélectionné(e) est incorrect(e)',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute must not have more than :max items.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => [
        'letters' => 'Le :attribute doit contenir au moins une lettre.',
        'mixed' => 'Le :attribute doit contenir au moins une lettre majuscule et une lettre minuscule.',
        'numbers' => 'Le :attribute doit contenir au moins un chiffre.',
        'symbols' => 'Le :attribute doit contenir au moins un symbole.',
        'uncompromised' => 'Le :attribute donné est apparu dans une fuite de données. Veuillez choisir un autre :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'Le champ :attribute est obligatoire.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'Le champ :attribute est obligatoire lorsque :other vaut :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'Le champ :attribute est obligatoire lorsque :values ​​est présent.',
    'required_with_all' => 'Le champ :attribute est obligatoire lorsque des :values sont présentes.',
    'required_without' => 'Le champ :attribute est obligatoire lorsque :values ​​n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est obligatoire lorsqu\'aucune des :values n\'est présente.',
    'same' => 'Le :attribute et :autre doivent correspondre.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'Le :attribute doit être une chaîne.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => ':attribute un déjà été pris.',
    'uploaded' => 'Le :attribute n\'a pas pu être téléchargé.',
    'url' => 'Le :attribute doit être une URL valide.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'dict_file_too_big' => 'Le fichier est trop volumineux. Veuillez sélectionner un fichier inférieur à :max_file_size MB.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        // App/Models/Artwork
        'exhibit_id' => 'exposition',
        'name' => 'nom',
        'description' => 'description',
        'location' => 'galerie ou lieu',
        'date' => 'date',
        'photographer' => 'photographe',
        'medium' => 'médium',
        'size' => 'dimension',
        'grant_acknowledgement' => 'reconnaissance de la subvention',
        'other_acknoledgements' => 'autres remerciements',
        'status' => 'statut',
        'size_lenght' => 'longueur',
        'size_width' => 'largeur',
        'size_height' => 'hauteur',
        'video_url' => 'vidéo',
        'photographer_link' => 'lien à leur site',
        // App/Models/Collection
        'owner_id' => 'propriétaire',
        'owner_type' => 'type de propriétaire',
        'status' => 'statut',
        'title' => 'titre',
        'description' => 'description',
        'additional_information_title' => 'ajoutez un titre',
        'additional_information_content' => 'ajoutez des informations supplémentaires',
        // App/Models/CollectionItem
        'collection_id' => 'collection',
        'model_id' => 'modèle',
        'model_type' => 'type de modèle',
        // App/Models/Comment
        'writer_id' => 'auteur',
        'writer_type' => 'type d\'auteur',
        'commentable_id' => 'à commenter',
        'commentable_type' => 'type à commenter',
        'text' => 'texte',
        // App/Models/Content
        'key' => 'clé',
        'type' => 'type',
        'status' => 'statut',
        'content' => 'contenu',
        // App/Models/Document
        'owner_id' => 'propriétaire',
        'owner_type' => 'type de propriétaire',
        'name' => 'nom',
        'description' => 'description',
        'status' => 'statut',
        // App/Models/Exhibit
        'owner_id' => 'propriétaire',
        'owner_type' => 'type de propriétaire',
        'name' => 'nom',
        'type' => 'type',
        'status' => 'statut',
        'description' => 'description',
        'locations' => 'locations',
        'dates' => 'dates',
        'location' => 'galerie ou lieu',
        'upcoming_date' => 'indiquer la date planifiée de cet expo',
        'open_at' => 'indiquer la date et l\'heure de son vernissage',
        'special_thanks' => 'Remerciement spécial',
        'grant_acknowledgement' => 'reconnaissance de la subvention',
        'other_acknoledgements' => 'autres remerciements',
        'additional_information_title' => 'ajoutez un titre',
        'additional_information_content' => 'ajoutez des informations supplémentaires',
        'transferor_type' => 'type de cédant',
        'transferor_id' => 'cédant',
        'transferred_at' => 'transféré à',
        // App/Models/Group
        'name' => 'nom',
        'type' => 'type',
        'institution_type' => 'type d\'institution',
        'art_practice_type' => 'type de pratique artistique',
        'address' => 'adresse',
        'country' => 'pays',
        'biography' => 'biographie',
        'mandate' => 'mandat',
        'member_of' => 'membre de',
        'additional_information_title' => 'ajoutez un titre',
        'additional_information_content' => 'ajoutez des informations supplémentaires',
        'status' => 'statut',
        'approved_at' => 'approuvé à',
        'specify_art_practice_type' => 'spécifier',
        'email' => 'adresse e-mail',
        'phone' => 'téléphone',
        // App/Models/RemoveFromDB
        'owner_type' => 'type de propriétaire',
        'owner_id' => 'propriétaire',
        'model_type' => 'type de modèle',
        'model_id' => 'modèle',
        // App/Models/User
        'can_access_admin' => 'peut accéder à l\'admin',
        'email' => 'adresse e-mail',
        'email_verified_at' => 'adresse email vérifié à',
        'email_verification_token' => 'jeton de vérification de l\'email',
        'password' => 'mot de passe',
        'first_name' => 'prénom',
        'last_name' => 'nom',
        'username' => 'nom d\'utilisateur',
        'status' => 'statut',
        'locale' => 'local',
        'address' => 'adresse',
        'remember_token' => 'mémoriser le jeton',
        'address' => 'adresse',
        'country' => 'pays',
        'city' => 'ville',
        'ethnicity' => 'identité culturelle',
        'pronoun' => 'pronom',
        // App/Models/UserEmail
        'user_id' => 'utilisateur',
        'email' => 'adresse e-mail',
        'email_verified_at' => 'adresse email vérifié à',
        'email_verification_token' => 'jeton de vérification de l\'adresse e-mail',
        'status' => 'statut',
        // App/Models/UserHasGroup
        'user_id' => 'utilisateur',
        'user_profile_id' => 'profil',
        'group_id' => 'groupe',
        'role' => 'rôle',
        'status' => 'statut',
        // App/Models/UserInvitation
        'guest_id' => 'invité',
        'inviter_id' => 'invitation',
        'subject_type' => 'type de sujet',
        'subject_id' => 'sujet',
        'first_name' => 'prénom',
        'last_name' => 'nom',
        'email' => 'adresse e-mail',
        'sent_at' => 'envoyé à',
        'send_copy' => 'envoyer une copie',
        // App/Models/UserNotification
        'user_id' => 'utilisateur',
        'ad_id' => 'annonce',
        'ad_comment_id' => 'commentaire',
        'user_review_id' => 'avis',
        'user_contact_id' => 'contact',
        'is_sent' => 'envoyé',
        'is_read' => 'lu',
        // App/Models/UserProfile
        'user_id' => 'utilisateur',
        'status' => 'statut',
        'type' => 'type',
        'artist_name' => 'nom d\'artiste',
        'other_artist_name' => 'autre nom d\'artiste',
        'pronoun' => 'pronom',
        'first_name' => 'prénom',
        'last_name' => 'nom',
        'username' => 'nom d\'utilisateur',
        'email' => 'adresse e-mail',
        'address' => 'adresse',
        'country' => 'pays',
        'ethnicity' => 'identité culturelle',
        'biography' => 'biographie',
        'artist_type' => 'type d\'artiste',
        'member_of' => 'membre de',
        'art_practice_type' => 'type de pratique artistique',
        'additional_information_title' => 'ajoutez un titre',
        'additional_information_content' => 'ajoutez des informations supplémentaires',
        'specify_artist_type' => 'spécifier',
        'specify_art_practice_type' => 'spécifier',
        // App/Models/Website
        'parent_id' => 'parent',
        'type' => 'type',
        'title' => 'titre',
        'description' => 'description',
        'url' => 'url',
        'owner_name' => 'nom du propriétaire',
        'owner_link' => 'lien au site du propriétaire',
        'additional_information_title' => 'ajoutez un titre',
        'additional_information_content' => 'ajoutez des informations supplémentaires',
        'status' => 'statut',
        // App/Models/WebsiteGroup
        'owner_id' => 'propriétaire',
        'owner_type' => 'type de propriétaire',
        'type' => 'type',
        'title' => 'titre',
        'description' => 'description',
        'additional_information_title' => 'ajoutez un titre',
        'additional_information_content' => 'ajoutez des informations supplémentaires',
        'status' => 'statut',
        'specify_website_group_type' => 'spécifier',
        // Other
        'current_password' => 'mot de passe actuel',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Values  (:value)
    |--------------------------------------------------------------------------
    |
    */

    'values' => [
        'type' => [
            Status::ENABLED => 'Public',
            Status::DELETED => 'Supprimé',
            Status::CANCELED => 'Annulé',
            Status::DISABLED => 'Privé',
            Status::PENDING => 'En attente',
            Status::PENDING_CONSENT => 'Consentement en attente',
            Status::BANNED => 'Interdit',
            Status::INVALID => 'Invalide',
            Status::DRAFT => 'Brouillon',
            Status::AWAITING_SUBMISSION => 'En attente de soumission',
            Status::SENT => 'Envoyé',
            Status::WAITING_FOR_VALIDATION => 'En attente de validation',
            Status::AWAITING_APPROVAL => 'En attente d\'approbation',
            Status::ACCEPTED => 'Accepté',
            Status::REFUSED => 'Refusé',
            Status::ADDED => 'Ajouté',
            Status::TO_VERIFIED_GALLERIES_ONLY => 'Uniquement aux Org.',

            ArtistType::AMATEUR => 'Amat.rice.eur',
            ArtistType::STUDENT => 'Étudiant.e',
            ArtistType::EMERGING => 'Émergent.e',
            ArtistType::PROFESSIONAL_ARTIST => 'Artiste professionnel.le',
            ArtistType::OTHER => 'Autre',

            ArtPracticeType::CONTEMPORARY => 'Contemporain',
            ArtPracticeType::ILLUSTRATION => 'Illustration',
            ArtPracticeType::INSTALLATION => 'Installation',
            ArtPracticeType::MULTIDISCIPLINARY => 'Multidisciplinaire',
            ArtPracticeType::MEDIA => 'Médiatique',
            ArtPracticeType::DIGITAL => 'Numérique',
            ArtPracticeType::PAINTING => 'Peinture',
            ArtPracticeType::PERFORMANCE => 'Performance',
            ArtPracticeType::PHOTOGRAPHY => 'Photographie',
            ArtPracticeType::OTHER => 'Autre',

            ProfileType::ARTIST => 'Artiste',
            ProfileType::CURATOR => 'Commissaire',
            ProfileType::PUBLIC_COLLECTOR => 'Public, Collectionneu.se.r',

            InstitutionType::ARTIST_RUN_CENTER => 'Centre d\'artistes',
            InstitutionType::ARTS_ORGANISATION => 'Organisation artistique',
            InstitutionType::ARTS_INSTITUTION => 'Institution artistique',
            InstitutionType::UNIVERSITY_GALLERY => 'Galerie universitaire',

            GroupType::ARTIST_RUN_CENTER_ORG => 'Organisation d\'un centre géré par des artistes',
            GroupType::ARTIST => 'Artiste',
            GroupType::CURATOR => 'Commissaire',

            ExhibitType::SOLO => 'Solo',
            ExhibitType::DUO => 'Duo',
            ExhibitType::GROUP => 'Groupe',
            ExhibitType::RESIDENCY => 'Résidence',

            MemberType::ADMINISTRATOR => 'Administrateur',
            MemberType::MEMBER => 'Membre',

            WebsiteGroupType::ARTIST_WEBSITES => 'Sites d\'artistes',
            WebsiteGroupType::STORE => ' Magasin',
            WebsiteGroupType::PROJECTS_INITIATIVES => 'Projets-Initiatives',
            WebsiteGroupType::SOCIAL_MEDIA => 'Médias sociaux',
            WebsiteGroupType::OTHER => 'Autre',
        ],
    ],

];
