@props([
    'item',
    'type',
])

@php
    if (!isset($type)) {
        throw new \InvalidArgumentException("Missing required 'type' prop in edit component.");
    }

    if (!is_object($item) || !isset($item->id)) {
        throw new \InvalidArgumentException("Invalid or missing 'item' prop in edit component.");
    }

    $profileSession = app('profile.session');

    $typeMap = [
        'exhibit' => [
            'ownership' => fn($session, $item) => $session->isOwnerOfThisExhibit($item),
            'route' => fn($item) => $item->belongsToProfile()
                ? route('my-profile.my-exhibits.show', ['my_profile' => $item->owner_id, 'my_exhibit' => $item->id])
                : route('my-group.my-exhibits.show', ['my_group' => $item->owner_id, 'my_exhibit' => $item->id]),
        ],
        'artwork' => [
            'ownership' => fn($session, $item) => $session->isOwnerOfThisArtwork($item),
            'route' => fn($item) => $item->exhibit->belongsToProfile()
                ? route('my-profile.my-exhibits.my-artworks.show', [
                    'my_profile' => $item->exhibit->owner_id,
                    'my_exhibit' => $item->exhibit->id,
                    'my_artwork' => $item->id,
                ])
                : route('my-group.my-exhibits.my-artworks.show', [
                    'my_group' => $item->exhibit->owner_id,
                    'my_exhibit' => $item->exhibit->id,
                    'my_artwork' => $item->id,
                ]),
        ],
        'websiteGroup' => [
            'ownership' => fn($session, $item) => $session->isOwnerOfThisWebsiteGroup($item),
            'route' => fn($item) => $item->belongsToProfile()
                ? route('my-profile.my-website-groups.show', [
                    'my_profile' => $item->owner_id,
                    'my_website_group' => $item->id,
                ])
                : route('my-group.my-website-groups.show', [
                    'my_group' => $item->owner_id,
                    'my_website_group' => $item->id,
                ]),
        ],
        'website' => [
            'ownership' => fn($session, $item) => $session->isOwnerOfThisWebsite($item),
            'route' => fn($item) => $item->parent->belongsToProfile()
                ? route('my-profile.my-website-groups.my-websites.show', [
                    'my_profile' => $item->parent->owner_id,
                    'my_website_group' => $item->parent->id,
                    'my_website' => $item->id,
                ])
                : route('my-group.my-website-groups.my-websites.show', [
                    'my_group' => $item->parent->owner_id,
                    'my_website_group' => $item->parent->id,
                    'my_website' => $item->id,
                ]),
        ],
        'collection' => [
            'ownership' => fn($session, $item) => $session->isOwnerOfThisCollection($item),
            'route' => fn($item) => $item->belongsToProfile()
                ? route('my-profile.my-collections.show', [
                    'my_profile' => $item->owner_id,
                    'my_collection' => $item->id,
                ])
                : route('my-group.my-collections.show', [
                    'my_group' => $item->owner_id,
                    'my_collection' => $item->id,
                ]),
        ],
        'profile' => [
            'ownership' => fn($session, $item) => $session->is($item),
            'route' => fn($item) => $item->isProfile()
                ? route('my-profile.show', ['my_profile' => $item->id])
                : route('my-group.show', ['my_group' => $item->id]),
        ],
    ];

    if (!array_key_exists($type, $typeMap)) {
        throw new \InvalidArgumentException("Unsupported type '{$type}' passed to edit component.");
    }

    $map = $typeMap[$type];
    $isOwner = $map['ownership']($profileSession, $item);
    $route = $isOwner ? $map['route']($item) : null;
@endphp

@if ($isOwner && $route)
    <a href="{{ $route }}" role="button" class="elementor-button outline borderless edit-btn">
        <span class="elementor-button-content-wrapper">
            <span class="elementor-button-text">
                <i class="fa fa-pencil"></i>
            </span>
        </span>
    </a>
@endif
