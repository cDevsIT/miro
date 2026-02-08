@extends('layouts.app')

@section('title', $project->title . ' - Miro Lighting')

@push('meta')
    @php
        $shareUrl = url()->current();
        $shareTitle = $project->title;
        $shareDescription = $project->subtitle ?: Str::limit(strip_tags($project->intro ?? ''), 160);
        $shareImage = $project->feature_image ? asset('storage/' . $project->feature_image) : '';
    @endphp
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $shareUrl }}">
    <meta property="og:title" content="{{ $shareTitle }}">
    <meta property="og:description" content="{{ $shareDescription }}">
    @if($shareImage)
    <meta property="og:image" content="{{ $shareImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $shareUrl }}">
    <meta name="twitter:title" content="{{ $shareTitle }}">
    <meta name="twitter:description" content="{{ $shareDescription }}">
    @if($shareImage)
    <meta name="twitter:image" content="{{ $shareImage }}">
    @endif
@endpush

@section('content')
    <div class="project-details-container">
        <div class="project-details-header">
            <img src="{{ asset('storage/' . $project->feature_image) }}" alt="{{ $project->title }}" class="project-details-image" />
        </div>

        <div class="project-details-content container">
            <div class="project-details-content-left">
                <div class="project-details-share">
                    <span class="project-details-share-icon-title">
                        <img src="{{ asset('images/BLOG 5 Ways to Elevate Your Space with/SHARE.svg') }}" alt="Share" class="project-details-share-icon" />
                        <span>Share this project</span>
                    </span>
                    @php
                        $facebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode($shareUrl);
                        $linkedInUrl = 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode($shareUrl);
                        $emailUrl = 'mailto:?subject=' . rawurlencode($shareTitle) . '&body=' . rawurlencode($shareUrl . "\n\n" . $shareTitle . ($shareDescription ? "\n" . $shareDescription : ''));
                    @endphp
                    <div class="project-details-share-icons">
                        <a href="{{ $emailUrl }}" class="project-details-share-link" title="Share via Email" aria-label="Share via Email">
                            <img src="{{ asset('images/icons/EMAIL-LOGO.svg') }}" alt="Email" class="project-details-share-icon" />
                        </a>
                        <a href="{{ $facebookUrl }}" class="project-details-share-link" target="_blank" rel="noopener noreferrer" title="Share on Facebook" aria-label="Share on Facebook">
                            <img src="{{ asset('images/icons/FACEBOOK-LOGO.svg') }}" alt="Facebook" class="project-details-share-icon" />
                        </a>
                        <a href="https://www.instagram.com/" class="project-details-share-link" target="_blank" rel="noopener noreferrer" title="Share on Instagram" aria-label="Share on Instagram">
                            <img src="{{ asset('images/icons/INSTRAGRAM-LOGO.svg') }}" alt="Share on Instagram" class="project-details-share-icon project-details-instagram-icon" />
                        </a>
                        <a href="{{ $linkedInUrl }}" class="project-details-share-link" target="_blank" rel="noopener noreferrer" title="Share on LinkedIn" aria-label="Share on LinkedIn">
                            <img src="{{ asset('images/icons/LINKDIN-LOGO.svg') }}" alt="LinkedIn" class="project-details-share-icon" />
                        </a>
                    </div>
                </div>
                <h1 class="project-details-title">{{ $project->title }}</h1>
                <div class="project-details-info">
                    @if($project->info_location)
                    <div class="project-details-info-item">
                        <span class="project-details-info-label">
                            <img src="{{ asset('images/icons/LOCATION.svg') }}" alt="" class="project-details-share-icon" />
                            <p>Location:</p>
                        </span>
                        <span>{{ $project->info_location }}</span>
                    </div>
                    @endif
                    @if($project->info_client)
                    <div class="project-details-info-item">
                        <span class="project-details-info-label">
                            <img src="{{ asset('images/icons/CLIENT.svg') }}" alt="" class="project-details-share-icon" />
                            <p>Client:</p>
                        </span>
                        <span>{{ $project->info_client }}</span>
                    </div>
                    @endif
                    @if($project->info_year)
                    <div class="project-details-info-item">
                        <span class="project-details-info-label">
                            <img src="{{ asset('images/icons/CALENDER.svg') }}" alt="" class="project-details-share-icon" />
                            <p>Year:</p>
                        </span>
                        <span>{{ $project->info_year }}</span>
                    </div>
                    @endif
                    @if($project->info_photographs)
                    <div class="project-details-info-item">
                        <span class="project-details-info-label">
                            <img src="{{ asset('images/icons/CAMERA.svg') }}" alt="" class="project-details-share-icon" />
                            <p>Photographs:</p>
                        </span>
                        <span>{{ $project->info_photographs }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="project-details-description-container">
                @if($project->subtitle)
                    <h2>{{ $project->subtitle }}</h2>
                @endif
                @if($project->intro)
                    <p class="project-details-description">{{ $project->intro }}</p>
                @endif
            </div>
        </div>
    </div>

    @if($project->sections && count($project->sections) > 0)
        @foreach($project->sections as $section)
            @if($section['type'] === 'full_image')
                <div class="container">
                    <img src="{{ asset('storage/' . $section['image']) }}" alt="Section Image" class="project-details-benefits-image" />
                </div>

            @elseif($section['type'] === 'text')
                <div class="project-details-benefits container">
                    @if(!empty($section['title']))
                        <h2 class="project-details-benefits-title">{{ $section['title'] }}</h2>
                    @endif
                    <div class="project-details-benefits-description">{!! $section['text'] !!}</div>
                </div>

            @elseif($section['type'] === 'right_image')
                <div class="project-details-concept">
                    <div class="project-details-concept-container container">
                        <div class="project-details-concept-text">
                            @if(!empty($section['title']))
                                <h2 class="project-details-concept-title">{{ $section['title'] }}</h2>
                            @endif
                            <div class="project-details-concept-description">{!! $section['text'] !!}</div>
                        </div>
                        <img src="{{ asset('storage/' . $section['image']) }}" alt="{{ $section['title'] ?? 'Section Image' }}" class="project-details-concept-image" />
                    </div>
                </div>

            @elseif($section['type'] === 'left_image')
                <div class="project-details-concept">
                    <div class="project-details-concept-container container">
                        <img src="{{ asset('storage/' . $section['image']) }}" alt="{{ $section['title'] ?? 'Section Image' }}" class="project-details-concept-image" />
                        <div class="project-details-concept-text">
                            @if(!empty($section['title']))
                                <h2 class="project-details-concept-title">{{ $section['title'] }}</h2>
                            @endif
                            <div class="project-details-concept-description">{!! $section['text'] !!}</div>
                        </div>
                    </div>
                </div>

            @elseif($section['type'] === 'double_image')
                <div class="container">
                    <div class="project-details-climbing-grid">
                        @if(!empty($section['image_1']))
                            <img src="{{ asset('storage/' . $section['image_1']) }}" alt="Section Image 1" class="project-details-climbing-image" />
                        @endif
                        @if(!empty($section['image_2']))
                            <img src="{{ asset('storage/' . $section['image_2']) }}" alt="Section Image 2" class="project-details-climbing-image" />
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endsection

@push('scripts')
    @vite(['resources/css/ProjectDetails.css', 'resources/css/blog-page2.css'])
@endpush
