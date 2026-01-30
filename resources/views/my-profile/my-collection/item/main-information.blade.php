@isset($item)
    <div id="dokan-seller-listing-wrap" class="grid-view">
        <div class="seller-listing-content">
            <ul class="dokan-seller-wrap">
                @php
                    $ownerKey = $item->collection->belongsToProfile() ? 'my_profile' : 'my_group';
                    $routePrefix = $item->collection->belongsToProfile()
                        ? 'my-profile.my-collections.items'
                        : 'my-group.my-collections.items';
                    $ownerId = $item->collection->owner_id;
                    $collectionId = $item->collection_id;

                    $mediaViewMap = [
                        'Exhibit' => 'exhibit',
                        'Artwork' => 'artwork',
                        'Collection' => 'collection',
                        'CollectionItem' => 'item',
                        'WebsiteGroup' => 'website-group',
                        'Website' => 'website',
                        'UserProfile' => 'profile',
                        'Group' => 'group',
                    ];

                    $viewVarNameMap = [
                        'Exhibit' => 'exhibit',
                        'Artwork' => 'artwork',
                        'Collection' => 'collection',
                        'CollectionItem' => 'item',
                        'WebsiteGroup' => 'websiteGroup',
                        'Website' => 'website',
                        'UserProfile' => 'profile',
                        'Group' => 'group',
                    ];
                @endphp

                @foreach ($item->isCollection() ? $item->model->items : [$item] as $childItem)
                    @php
                        $model = $childItem->model;
                        $morphClass = $childItem->getMorphClass(true);
                        $viewName = $mediaViewMap[$morphClass] ?? \Illuminate\Support\Str::kebab($morphClass);
                        $viewVarName = $viewVarNameMap[$morphClass] ?? lcfirst(class_basename($model));
                        $title = $childItem->getTitle();
                        $description = $childItem->getDescription();
                    @endphp

                    <li class="dokan-single-seller woocommerce coloum-3">
                        <a href="{{ route($routePrefix . '.show', [
                            $ownerKey => $ownerId,
                            'my_collection' => $collectionId,
                            'item' => $childItem->id
                        ]) }}">
                            <div class="store-wrapper">
                                <div class="store-header">
                                    <div class="store-banner">
                                        @includeIf("components.media.{$viewName}", [
                                            $viewVarName => $model,
                                            'showIFrame' => true
                                        ])
                                    </div>
                                </div>

                                <div class="store-content">
                                    <div class="store-data-container">
                                        @if (method_exists($model, 'isEnabled'))
                                            <span class="dokan-store-is-open-close-status {{ $model->isEnabled() ? '' : 'dokan-store-is-closed-status' }}">
                                                {{ $model->isEnabled()
                                                    ? __('my-collection.views.index.ul.li.span.published')
                                                    : __('my-collection.views.index.ul.li.span.unpublished') }}
                                            </span>
                                        @endif

                                        @if (empty($description))
                                            <div class="featured-favourite"></div>
                                        @endif

                                        <div class="store-data">
                                            <h2>{{ $title }}</h2>
                                            <p>{{ \Illuminate\Support\Str::limit($description, 50) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="store-footer">
                                    @if ($item->collection->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($item->collection->owner))
                                        <a href="#delete-row-dialog-item-{{ $childItem->id }}" class="button delete popup-delete-row">
                                            <i class="sl sl-icon-trash"></i>
                                        </a>
                                        <div id="delete-row-dialog-item-{{ $childItem->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                            <div class="small-dialog-header">
                                                <h3>{{ __('my-collection.views.show.ul.li.button.h3.delete-item') }}</h3>
                                            </div>
                                            <div class="sign-in-form style-1">
                                                <p>{{ __('my-collection.views.show.ul.li.button.p.sure') }}</p>
                                                <form method="post" action="{{ route($routePrefix . '.destroy', [
                                                    $ownerKey => $ownerId,
                                                    'my_collection' => $collectionId,
                                                    'item' => $childItem->id
                                                ]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="button">
                                                        {{ __('my-collection.views.show.ul.li.button.form.button.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Sortable dropdown --}}
                                        <select onchange="location = this.value;" class="select2-single" data-placeholder="All positions">
                                            @for ($position = 1; $position <= $item->collection->items->count(); $position++)
                                                <option
                                                    @if ($childItem->order_column == $position) selected @endif
                                                    value="{{ route($routePrefix . '.change-position', [
                                                        $ownerKey => $ownerId,
                                                        'my_collection' => $collectionId,
                                                        'item' => $childItem->id,
                                                        'position' => $position
                                                    ]) }}"
                                                >Position {{ $position }}</option>
                                            @endfor
                                        </select>
                                        {{-- End Sortable dropdown --}}
                                    @endif
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach

                <div class="dokan-clearfix"></div>
            </ul>
        </div>
    </div>

    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.popup-delete-row').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'art-mfp-zoom-in'
            });
        });
    </script>
    @endpush
@endisset
