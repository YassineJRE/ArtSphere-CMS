@if ($group->isArtist())
    @include('my-group.edit-artist-group')
@elseif ($group->isCurator())
    @include('my-group.edit-curator-group')
@elseif ($group->isArtistRunCenterOrganisation())
    @include('my-group.edit-artist-run-center-gallery')
@endif