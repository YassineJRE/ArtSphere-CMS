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
    'active_url' => 'The :attribute is not a valid URL.',
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
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
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
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
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
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
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
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'dict_file_too_big' => 'File is too big. Please select a file less than :max_file_size MB.',

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
        'exhibit_id' => 'exhibit',
        'name' => 'name',
        'description' => 'description',
        'location' => 'gallery or location',
        'date' => 'date',
        'photographer' => 'photographer',
        'medium' => 'medium',
        'size' => 'size',
        'grant_acknowledgement' => 'grant recognition',
        'other_acknoledgements' => 'other acknowledgements',
        'status' => 'status',
        'size_lenght' => 'size lenght',
        'size_width' => 'size width',
        'size_height' => 'size height',
        'video_url' => 'video',
        'photographer_link' => 'link to their website',
        // App/Models/Collection
        'owner_id' => 'owner',
        'owner_type' => 'owner type',
        'status' => 'status',
        'title' => 'title',
        'description' => 'description',
        'additional_information_title' => 'add a title',
        'additional_information_content' => 'add additional information',
        // App/Models/CollectionItem
        'collection_id' => 'collection',
        'model_id' => 'model',
        'model_type' => 'model type',
        // App/Models/Comment
        'writer_id' => 'writer',
        'writer_type' => 'writer type',
        'commentable_id' => 'commentable',
        'commentable_type' => 'commentable type',
        'text' => 'text',
        // App/Models/Content
        'key' => 'key',
        'type' => 'type',
        'status' => 'status',
        'content' => 'content',
        // App/Models/Document
        'owner_id' => 'owner',
        'owner_type' => 'owner type',
        'name' => 'name',
        'description' => 'description',
        'status' => 'status',
        // App/Models/Exhibit
        'owner_id' => 'owner',
        'owner_type' => 'owner type',
        'name' => 'name',
        'type' => 'type',
        'status' => 'status',
        'description' => 'description',
        'locations' => 'locations',
        'dates' => 'dates',
        'location' => 'location or gallery',
        'upcoming_date' => 'indicate the planned date of this exhibition',
        'open_at' => 'indicate the date and time of the opening',
        'special_thanks' => 'special thanks',
        'grant_acknowledgement' => 'grant recognition',
        'other_acknoledgements' => 'other acknowledgements',
        'additional_information_title' => 'add a title',
        'additional_information_content' => 'add additional information',
        'transferor_type' => 'transferor type',
        'transferor_id' => 'transferor',
        'transferred_at' => 'transferred at',
        // App/Models/Group
        'name' => 'name',
        'type' => 'type',
        'institution_type' => 'institution type',
        'art_practice_type' => 'art practice type',
        'address' => 'address',
        'country' => 'country',
        'biography' => 'biography',
        'mandate' => 'mandate',
        'member_of' => 'member of',
        'additional_information_title' => 'add a title',
        'additional_information_content' => 'add additional information',
        'status' => 'status',
        'approved_at' => 'approved at',
        'specify_art_practice_type' => 'specify',
        'email' => 'email address',
        'phone' => 'phone',
        // App/Models/RemoveFromDB
        'owner_type' => 'owner type',
        'owner_id' => 'owner',
        'model_type' => 'model type',
        'model_id' => 'model',
        // App/Models/User
        'can_access_admin' => 'can access admin',
        'email' => 'email address',
        'email_verified_at' => 'email verified at',
        'email_verification_token' => 'email verification token',
        'password' => 'password',
        'first_name' => 'first name',
        'last_name' => 'last name',
        'username' => 'username',
        'status' => 'status',
        'locale' => 'locale',
        'address' => 'address',
        'remember_token' => 'remember token',
        'address' => 'address',
        'country' => 'country',
        'city' => 'city',
        'ethnicity' => 'cultural identity',
        'pronoun' => 'pronoun',
        // App/Models/UserEmail
        'user_id' => 'user',
        'email' => 'email address',
        'email_verified_at' => 'email verified at',
        'email_verification_token' => 'email verification token',
        'status' => 'status',
        // App/Models/UserHasGroup
        'user_id' => 'user',
        'user_profile_id' => 'profile',
        'group_id' => 'group',
        'role' => 'role',
        'status' => 'status',
        // App/Models/UserInvitation
        'guest_id' => 'guest',
        'inviter_id' => 'inviter',
        'subject_type' => 'subject type',
        'subject_id' => 'subject',
        'first_name' => 'first name',
        'last_name' => 'last name',
        'email' => 'email address',
        'sent_at' => 'sent at',
        'send_copy' => 'send copy',
        // App/Models/UserNotification
        'user_id' => 'user',
        'ad_id' => 'ad',
        'ad_comment_id' => 'comment',
        'user_review_id' => 'review',
        'user_contact_id' => 'contact',
        'is_sent' => 'is sent',
        'is_read' => 'is read',
        // App/Models/UserProfile
        'user_id' => 'user',
        'status' => 'status',
        'type' => 'type',
        'artist_name' => 'artist name',
        'other_artist_name' => 'other artist name',
        'pronoun' => 'pronoun',
        'first_name' => 'first name',
        'last_name' => 'last name',
        'username' => 'username',
        'email' => 'email address',
        'address' => 'address',
        'country' => 'country',
        'ethnicity' => 'ethnicity',
        'biography' => 'biography',
        'artist_type' => 'artist type',
        'member_of' => 'member of',
        'art_practice_type' => 'art practice type',
        'additional_information_title' => 'add a title',
        'additional_information_content' => 'add additional information',
        'specify_artist_type' => 'specify',
        'specify_art_practice_type' => 'specify',
        // App/Models/Website
        'parent_id' => 'parent',
        'type' => 'type',
        'title' => 'title',
        'description' => 'description',
        'url' => 'url',
        'owner_name' => 'owner\'s name',
        'owner_link' => 'link to owner\'s site',
        'additional_information_title' => 'add a title',
        'additional_information_content' => 'add additional information',
        'status' => 'status',
        // App/Models/WebsiteGroup
        'owner_id' => 'owner',
        'owner_type' => 'owner type',
        'type' => 'type',
        'title' => 'title',
        'description' => 'description',
        'additional_information_title' => 'add a title',
        'additional_information_content' => 'add additional information',
        'status' => 'status',
        'specify_website_group_type' => 'specify',
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
            Status::DELETED => 'Deleted',
            Status::CANCELED => 'Canceled',
            Status::DISABLED => 'Private',
            Status::PENDING => 'Pending',
            Status::PENDING_CONSENT => 'Pending consent',
            Status::BANNED => 'Banned',
            Status::INVALID => 'Invalid',
            Status::DRAFT => 'Draft',
            Status::AWAITING_SUBMISSION => 'Awaiting submission',
            Status::SENT => 'sent',
            Status::WAITING_FOR_VALIDATION => 'Waiting for validation',
            Status::AWAITING_APPROVAL => 'Awaiting approval',
            Status::ACCEPTED => 'Accepted',
            Status::REFUSED => 'Refused',
            Status::ADDED => 'Added',
            Status::TO_VERIFIED_GALLERIES_ONLY => 'Org. Only',

            ArtistType::AMATEUR => 'Hobbyist',
            ArtistType::STUDENT => 'Student',
            ArtistType::EMERGING => 'Emerging',
            ArtistType::PROFESSIONAL_ARTIST => 'Professional artist',
            ArtistType::OTHER => 'Other',

            ArtPracticeType::CONTEMPORARY => 'Contemporary',
            ArtPracticeType::ILLUSTRATION => 'Illustration',
            ArtPracticeType::INSTALLATION => 'installation',
            ArtPracticeType::MULTIDISCIPLINARY => 'Multidisciplinary',
            ArtPracticeType::MEDIA => 'Media',
            ArtPracticeType::DIGITAL => 'Digital',
            ArtPracticeType::PAINTING => 'Painting',
            ArtPracticeType::PERFORMANCE => 'Performance',
            ArtPracticeType::PHOTOGRAPHY => 'Photography',
            ArtPracticeType::OTHER => 'Other',

            ProfileType::ARTIST => 'Artist',
            ProfileType::CURATOR => 'Curator',
            ProfileType::PUBLIC_COLLECTOR => 'Public - collector',

            InstitutionType::ARTIST_RUN_CENTER => 'Artist-Run Centre',
            InstitutionType::ARTS_ORGANISATION => 'Arts organisation',
            InstitutionType::ARTS_INSTITUTION => 'Arts institution',
            InstitutionType::UNIVERSITY_GALLERY => 'University gallery',

            GroupType::ARTIST_RUN_CENTER_ORG => 'Artist run center organisation',
            GroupType::ARTIST => 'Artist',
            GroupType::CURATOR => 'Curator',

            ExhibitType::SOLO => 'Solo',
            ExhibitType::DUO => 'Duo',
            ExhibitType::GROUP => 'Group',
            ExhibitType::RESIDENCY => 'Residency',

            MemberType::ADMINISTRATOR => 'Administrator',
            MemberType::MEMBER => 'Member',

            WebsiteGroupType::ARTIST_WEBSITES => 'Artist Websites',
            WebsiteGroupType::STORE => 'Store',
            WebsiteGroupType::PROJECTS_INITIATIVES => 'Projects-Initiatives',
            WebsiteGroupType::SOCIAL_MEDIA => 'Social Media',
            WebsiteGroupType::OTHER => 'Other',
        ],
    ],

];
