@if ($profile->isArtist())
    @include('my-profile.edit-artist-profile')
@elseif ($profile->isCurator())
    @include('my-profile.edit-curator-profile')
@elseif ($profile->isPublicCollector())    
    @include('my-profile.edit-public-collector-profile')
@endif