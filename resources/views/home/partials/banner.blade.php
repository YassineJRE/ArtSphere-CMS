@push('styles')

@endpush

<div class="main-search-container centered" data-background-image="{{ asset('img/background.jpg') }}">
	<div class="main-search-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>{{ __('components.views.banner.h2.artolog') }}</h2>
					<h4>{{ __('components.views.banner.h4.collective') }}</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="highlighted-categories">
						<a href="{{ route('app.exhibits.index') }}" class="highlighted-category">
					    	<h4>{{ __('components.views.banner.h4.discover') }}</h4>
						</a>

						<a href="{{ route('my-account.index') }}" 
							class="highlighted-category"
						>
					    	<h4>{{ __('components.views.banner.h4.archive') }}</h4>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')

@endpush
