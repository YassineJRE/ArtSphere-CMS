@props([
    'item',
    'type',
])

@php
    if (!isset($type)) {
        throw new \InvalidArgumentException("Missing required 'type' prop in remove-from-db component.");
    }

    if (!is_object($item) || !isset($item->id)) {
        throw new \InvalidArgumentException("Invalid or missing 'item' prop in remove-from-db component.");
    }

    $id = $item->id;
    $profileSession = app('profile.session');

    if ($type === 'profile' && method_exists($item, 'isGroup') && $item->isGroup()) {
        $type = 'group';
    }

    $typeMap = [
        'exhibit' => [
            'method' => 'hasRemovedThisExhibitFromDB',
            'input'  => 'exhibit_id',
        ],
        'artwork' => [
            'method' => 'hasRemovedThisArtworkFromDB',
            'input'  => 'artwork_id',
        ],
        'websiteGroup' => [
            'method' => 'hasRemovedThisWebsiteGroupFromDB',
            'input'  => 'website_group_id',
        ],
        'website' => [
            'method' => 'hasRemovedThisWebsiteFromDB',
            'input'  => 'website_id',
        ],
        'collection' => [
            'method' => 'hasRemovedThisCollectionFromDB',
            'input'  => 'collection_id',
        ],
        'collectionItem' => [
            'method' => 'hasRemovedThisCollectionItemFromDB',
            'input'  => 'collection_item_id',
        ],
        'profile' => [
            'method' => 'hasRemovedThisProfileFromDB',
            'input'  => 'user_profile_id',
        ],
        'group' => [
            'method' => 'hasRemovedThisGroupFromDB',
            'input'  => 'group_id',
        ],
    ];

    if (!array_key_exists($type, $typeMap)) {
        throw new \InvalidArgumentException("Unknown or unsupported type '{$type}' passed to remove-from-db component.");
    }

    $method = $typeMap[$type]['method'];
    $inputName = $typeMap[$type]['input'];

    if (!method_exists($profileSession, $method)) {
        throw new \RuntimeException("Missing method '{$method}' on profile session for type '{$type}' in remove-from-db component.");
    }

    $hasBeenRemoved = $profileSession->{$method}($item);

    $dialogId = "removeFromDB-row-dialog-{$id}";

    $actionRoute = $profileSession->isProfile()
        ? route('my-profile.my-model-removed.store', ['my_profile' => $profileSession->getProfileId()])
        : route('my-group.my-model-removed.store', ['my_group' => $profileSession->getProfileId()]);
@endphp

@if (!$hasBeenRemoved)
    <a href="#{{ $dialogId }}"
       role="button"
       class="elementor-button outline borderless remove-btn popup-row">
        <span class="elementor-button-content-wrapper">
            <span class="elementor-button-text">
                <i class="fa fa-minus"></i>
            </span>
        </span>
    </a>

    <div id="{{ $dialogId }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>{{ __('profile.views.remove.h3.remove-db') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            <form method="post" action="{{ $actionRoute }}">
                @csrf
                <input type="hidden" name="{{ $inputName }}" value="{{ $id }}">
                <p class="form-row">{{ __('profile.views.remove.sure') }}</p>
                <p class="form-row form-row-wide">
                    <button class="button">{{ __('profile.views.remove.button.remove-button') }}</button>
                </p>
            </form>
        </div>
    </div>
@endif
