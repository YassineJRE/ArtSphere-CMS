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
    ],
    'artist-type' => [
        ArtistType::AMATEUR => 'Amat.rice.eur',
        ArtistType::STUDENT => 'Étudiant.e',
        ArtistType::EMERGING => 'Émergent.e',
        ArtistType::PROFESSIONAL_ARTIST => 'Artiste professionnel.le',
        ArtistType::OTHER => 'Autre',
    ],
    'art-practice-type' => [
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
    ],
    'profile-type' => [
        ProfileType::ARTIST => 'Artiste',
        ProfileType::CURATOR => 'Commissaire',
        ProfileType::PUBLIC_COLLECTOR => 'Public, Collectionneu.se.r',
    ],
    'institution-type' => [
        InstitutionType::ARTIST_RUN_CENTER => 'Centre d\'artistes',
        InstitutionType::ARTS_ORGANISATION => 'Organisation artistique',
        InstitutionType::ARTS_INSTITUTION => 'Institution artistique',
        InstitutionType::UNIVERSITY_GALLERY => 'Galerie universitaire',
    ],
    'group-type' => [
        GroupType::ARTIST_RUN_CENTER_ORG => 'Organisation d\'un centre géré par des artistes',
        GroupType::ARTIST => 'Artiste',
        GroupType::CURATOR => 'Commissaire',
    ],
    'exhibit-type' => [
        ExhibitType::SOLO => 'Solo',
        ExhibitType::DUO => 'Duo',
        ExhibitType::GROUP => 'Groupe',
        ExhibitType::RESIDENCY => 'Résidence',
    ],
    'member-type' => [
        MemberType::ADMINISTRATOR => 'Administrateur',
        MemberType::MEMBER => 'Membre',
    ],
    'website-group-type' => [
        WebsiteGroupType::ARTIST_WEBSITES => 'Sites d\'artistes',
        WebsiteGroupType::STORE => ' Magasin',
        WebsiteGroupType::PROJECTS_INITIATIVES => 'Projets-Initiatives',
        WebsiteGroupType::SOCIAL_MEDIA => 'Médias sociaux',
        WebsiteGroupType::OTHER => 'Autre',
    ],
];
