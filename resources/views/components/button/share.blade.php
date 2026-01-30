@props([
    'item',
    'type',
])

@php
    if (!isset($type)) {
        throw new \InvalidArgumentException("Missing required 'type' prop in share component.");
    }

    if (!is_object($item) || !isset($item->id)) {
        throw new \InvalidArgumentException("Invalid or missing 'item' prop in share component.");
    }

    $id = $item->id;
    $dialogId = "share-row-dialog-{$id}";

    $url = match ($type) {
        'collectionItem' => $item->getModelRoute(),
        default => method_exists($item, 'getRoute') ? $item->getRoute() : null,
    };
@endphp

@if ($url)
    <a href="#{{ $dialogId }}" role="button" class="elementor-button outline borderless share-btn popup-row">
        <span class="elementor-button-content-wrapper">
            <span class="elementor-button-text">
                <i class="sl sl-icon-share"></i>
            </span>
        </span>
    </a>

    <div id="{{ $dialogId }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>{{ __('profile.views.dialog.title.share') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            <p>{{ __('profile.views.paragraph.copy-url') }}</p>
            <input
                id="inputTextToCopy-{{ $id }}"
                name="inputTextToCopy"
                type="text"
                value="{{ $url }}"
            >
            <button class="button" onclick="copyToClipboard('{{ $id }}')">
                {{ __('profile.views.button.copy-url') }}
            </button>
        </div>
    </div>
@endif
