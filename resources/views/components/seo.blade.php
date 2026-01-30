
{{-- SEO Meta Tags Component --}}
{{-- This component generates SEO meta tags for the page. It can be customized with various properties. --}}
{{-- Usage: <x-seo :title="$title" :description="$description" :keywords="$keywords" :image="$image" :canonical="$canonical" :robots="$robots" /> --}}

@props([
    'title' => config('app.name'),
    'description' => 'Plateforme de mise en valeur d\'artistes, de galeries et d\'expositions.',
    'keywords' => 'art, artistes, galeries, expositions, culture',
    'canonical' => url()->current(),
    'robots' => app()->environment('production') ? 'index, follow' : 'noindex, nofollow',
    'image' => asset('img/default-og.jpg'),
    'icon' => asset('img/favicon.png'),
])


<title>{{ $title }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="Artolog">
<meta name="robots" content="{{$robots}}">

<link rel="canonical" href="{{ $canonical }}" />
<link rel="shortlink" href="{{ route('app.home') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="generator" content="Artolog platform for Artists" />
<link rel="icon" type="image/svg+xml" href="{{asset('img/favicon.svg')}}">
<link rel="icon" type="image/png" href="{{ $icon }}">

<!-- Open Graph / Facebook -->
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{  url()->current() }}">
<meta property="og:type" content="website">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
