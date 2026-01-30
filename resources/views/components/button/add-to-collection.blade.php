@props([
    'item',
    'type',
])

@php
    if (!isset($type)) {
        throw new \InvalidArgumentException("Missing required 'type' prop in add-to-collection component.");
    }

    if (!is_object($item) || !isset($item->id)) {
        throw new \InvalidArgumentException("Invalid or missing 'item' prop in add-to-collection component.");
    }

    $id = $item->id;
    $profileSession = app('profile.session');
    $isProfile = $profileSession->isProfile();

    if ($type === 'profile' && method_exists($item, 'isGroup') && $item->isGroup()) {
        $type = 'group';
    }

    $typeMap = [
        'exhibit' => ['method' => 'hasThisExhibitInCollection', 'input' => 'exhibit_id'],
        'artwork' => ['method' => 'hasThisArtworkInCollection', 'input' => 'artwork_id'],
        'websiteGroup' => ['method' => 'hasThisWebsiteGroupInCollection', 'input' => 'website_group_id'],
        'website' => ['method' => 'hasThisWebsiteInCollection', 'input' => 'website_id'],
        'collection' => ['method' => 'hasThisCollectionInCollection', 'input' => 'collection_id'],
        'collectionItem' => ['method' => 'hasThisCollectionItemInCollection', 'input' => 'collection_item_id'],
        'profile' => ['method' => 'hasThisProfileInCollection', 'input' => 'user_profile_id'],
        'group' => ['method' => 'hasThisGroupInCollection', 'input' => 'group_id'],
    ];

    if (!array_key_exists($type, $typeMap)) {
        throw new \InvalidArgumentException("Unknown or unsupported type '{$type}' passed to add-to-collection component.");
    }

    $method = $typeMap[$type]['method'];
    $inputName = $typeMap[$type]['input'];

    if (!method_exists($profileSession, $method)) {
        throw new \RuntimeException("Missing method '{$method}' on profile session for type '{$type}' in add-to-collection component.");
    }

    $collections = ($type === 'collection')
        ? $profileSession->collections($item)
        : $profileSession->collections();

    $inCollection = $profileSession->{$method}($item);

    $dialogId = "addToCollection-row-dialog-{$id}";

    $firstCollectionId = $collections->isNotEmpty() ? $collections->first()->id : null;

    $routeItemsStore = null;
    if ($firstCollectionId) {
        $routeItemsStore = $isProfile
            ? route('my-profile.my-collections.items.store', ['my_profile' => $profileSession->getProfileId(), 'my_collection' => $firstCollectionId])
            : route('my-group.my-collections.items.store', ['my_group' => $profileSession->getProfileId(), 'my_collection' => $firstCollectionId]);
    }

    $routeCollectionsStore = $isProfile
        ? route('my-profile.my-collections.store', ['my_profile' => $profileSession->getProfileId()])
        : route('my-group.my-collections.store', ['my_group' => $profileSession->getProfileId()]);
@endphp

@if (!$inCollection)
    <a href="#{{ $dialogId }}"
       role="button"
       class="elementor-button outline borderless add-btn popup-row">
        <span class="elementor-button-content-wrapper">
            <span class="elementor-button-text">
                <i class="fa fa-plus"></i>
            </span>
        </span>
    </a>

    <div id="{{ $dialogId }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>{{ __('profile.views.button.add-to-collection') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            @if ($collections->count() > 0)
                <form id="formAddToCollection"
                      method="post"
                      @if ($routeItemsStore) action="{{ $routeItemsStore }}" @endif>
                    @csrf
                    <input type="hidden" name="{{ $inputName }}" value="{{ $id }}">

                    <p class="form-row form-row-wide">
                        <label for="collections">{{ __('profile.views.label.choose-collection') }}</label>
                        <select class="chosen-select"
                                id="collection"
                                onchange="document.getElementById('formAddToCollection').action=this.value">
                            @foreach ($collections as $collection)
                                <option value="{{ $isProfile
                                    ? route('my-profile.my-collections.items.store', [
                                        'my_profile' => $profileSession->getProfileId(),
                                        'my_collection' => $collection->id,
                                    ])
                                    : route('my-group.my-collections.items.store', [
                                        'my_group' => $profileSession->getProfileId(),
                                        'my_collection' => $collection->id,
                                    ]) }}">
                                    {{ $collection->title }}
                                </option>
                            @endforeach
                        </select>
                    </p>

                    <p class="form-row form-row-wide">
                        <input type="text"
                               name="title"
                               placeholder="{{ __('profile.views.placeholder.create-collection') }}"
                               data-action="{{ $routeCollectionsStore }}"
                               onkeyup="document.getElementById('formAddToCollection').action=this.value!=='' ? this.getAttribute('data-action') : document.getElementById('collection').value;"
                        >
                    </p>

                    <p class="form-row form-row-wide">
                        <button class="button">{{ __('profile.views.button.add') }}</button>
                    </p>
                </form>
            @else
                <form method="post"
                      action="{{ $routeCollectionsStore }}">
                    @csrf
                    <input type="hidden" name="{{ $inputName }}" value="{{ $id }}">

                    <p class="form-row form-row-wide">
                        <label for="title">{{ __('profile.views.label.enter-collection-name') }}</label>
                        <input type="text" name="title">
                    </p>

                    <p class="form-row form-row-wide">
                        <button class="button">{{ __('profile.views.button.add') }}</button>
                    </p>
                </form>
            @endif
        </div>
    </div>
@endif
