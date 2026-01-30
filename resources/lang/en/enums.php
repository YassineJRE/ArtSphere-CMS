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
    'status' => [
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
    ],
    'artist-type' => [
        ArtistType::AMATEUR => 'Hobbyist',
        ArtistType::STUDENT => 'Student',
        ArtistType::EMERGING => 'Emerging',
        ArtistType::PROFESSIONAL_ARTIST => 'Professional artist',
        ArtistType::OTHER => 'Other',
    ],
    'art-practice-type' => [
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
    ],
    'profile-type' => [
        ProfileType::ARTIST => 'Artist',
        ProfileType::CURATOR => 'Curator',
        ProfileType::PUBLIC_COLLECTOR => 'Public - collector',
    ],
    'institution-type' => [
        InstitutionType::ARTIST_RUN_CENTER => 'Artist-Run Centre',
        InstitutionType::ARTS_ORGANISATION => 'Arts organisation',
        InstitutionType::ARTS_INSTITUTION => 'Arts institution',
        InstitutionType::UNIVERSITY_GALLERY => 'University gallery',
    ],
    'group-type' => [
        GroupType::ARTIST_RUN_CENTER_ORG => 'Artist run center organisation',
        GroupType::ARTIST => 'Artist',
        GroupType::CURATOR => 'Curator',
    ],
    'exhibit-type' => [
        ExhibitType::SOLO => 'Solo',
        ExhibitType::DUO => 'Duo',
        ExhibitType::GROUP => 'Group',
        ExhibitType::RESIDENCY => 'Residency',
    ],
    'member-type' => [
        MemberType::ADMINISTRATOR => 'Administrator',
        MemberType::MEMBER => 'Member',
    ],
    'website-group-type' => [
        WebsiteGroupType::ARTIST_WEBSITES => 'Artist Websites',
        WebsiteGroupType::STORE => 'Store',
        WebsiteGroupType::PROJECTS_INITIATIVES => 'Projects-Initiatives',
        WebsiteGroupType::SOCIAL_MEDIA => 'Social Media',
        WebsiteGroupType::OTHER => 'Other',
    ],
];
