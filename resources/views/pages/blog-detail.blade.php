@extends('layouts.app')

@section('title', $blog->title . ' - Miro Lighting')

@push('meta')
    @php
        $shareUrl = url()->current();
        $shareTitle = $blog->title;
        $shareDescription = Str::limit(strip_tags($blog->intro ?? ''), 160);
        $shareImage = $blog->feature_image ? asset('storage/' . $blog->feature_image) : '';
    @endphp
    <meta property="og:type" content="article">
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
    <!-- Feature Image Banner -->
    <div class="blogBannerContainer">
        @if(($blog->category ?? 'general') === 'product')
            @php
                $productType = $blog->product_category === 'outdoor_product' ? 'outdoor' : 'indoor';
                $productTypeLabel = $blog->product_category === 'outdoor_product' ? 'Outdoor Products' : 'Indoor Products';
            @endphp
            <div class="single-product-blog">
                <a href="{{ url('/products/category/' . $productType) }}">{{ $productTypeLabel }}</a>
                <span class="breadcrumb-slash">/</span>
                <a class="breadcrumb-last" href="{{ url()->current() }}">{{ $blog->title }}</a>
            </div>
        @endif
        <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="{{ $blog->title }}" class="blogBannerImage" />
    </div>

    <!-- Blog Details -->
    <div class="detailsContainer">
        <div class="detailsText">
            <div class="detailsIcons project-details-share">
                <span class="project-details-share-icon-title">
                    <img src="{{ asset('images/BLOG 5 Ways to Elevate Your Space with/SHARE.svg') }}" alt="Share" class="project-details-share-icon" />
                    <span>Share this blog</span>
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
            <div class="detailsBorder"></div>
            <div class="detailsTitle">{{ $blog->title }}</div>
        </div>

        <div class="detailsDescription">
            {{ $blog->intro }}
        </div>
    </div>

    <!-- Dynamic Sections -->
    @if($blog->sections && count($blog->sections) > 0)
        @foreach($blog->sections as $index => $section)
            @php
                $isEven = $index % 2 == 0;
            @endphp

            @if($section['type'] === 'double_image')
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

            @elseif($section['type'] === 'full_image')
                <!-- Full Width Image Section (same structure as BlogInstallation.jsx Section-3 image part) -->
                <div class="picture-text-blog-product">
                    <div class="pictureDiv visionPicture">
                        <img src="{{ asset('storage/' . $section['image']) }}" alt="Section Image" class="detailsBannerImage" />
                    </div>
                </div>

            @elseif($section['type'] === 'text')
                <!-- Text Only Section (picture-text-blog-product > detailsImage > detailsHeadingImage + detailsDescriptionImage) -->
                <div class="picture-text-blog-product">
                    <div class="detailsImage visionText">
                        @if(!empty($section['title']))
                            <div class="detailsHeadingImage">{{ $section['title'] }}</div>
                        @endif
                        <div class="detailsDescriptionImage">
                            {!! $section['text'] !!}
                        </div>
                    </div>
                </div>

            @elseif($section['type'] === 'right_image')
                <!-- Right Image Section (Text Left, Image Right) -->
                @if($isEven)
                    <div class='fit-shine-box lighting-adapt'>
                        <div class="fitShine-text-box">
                            <div class="text-fitShine">
                                @if(!empty($section['title']))
                                    <h2>{{ $section['title'] }}</h2>
                                @endif
                                <div>{!! $section['text'] !!}</div>
                            </div>
                        </div>
                        <div class="fitShine-image-box lighting-adapt-img-box">
                            <img src="{{ asset('storage/' . $section['image']) }}" alt="{{ $section['title'] ?? 'Section Image' }}" />
                        </div>
                        <div class="fitShine-gap-box"></div>
                    </div>
                @else
                    <div class='picture-text-blog-product'>
                        <div class="pictureDiv visionPicture">
                            <img src="{{ asset('storage/' . $section['image']) }}" alt="{{ $section['title'] ?? 'Section Image' }}" class="detailsBannerImage" />
                        </div>
                        <div class="detailsImage visionText">
                            @if(!empty($section['title']))
                                <div class="detailsHeadingImage">
                                    {{ $section['title'] }}
                                </div>
                            @endif
                            <div class="detailsDescriptionImage">
                                {!! $section['text'] !!}
                            </div>
                        </div>
                    </div>
                @endif

            @elseif($section['type'] === 'left_image')
                <!-- Left Image Section (Image Left, Text Right) -->
                @if($isEven)
                    <div class='fit-shine-box lighting-adapt'>
                        <div class="fitShine-gap-box"></div>
                        <div class="fitShine-image-box lighting-adapt-img-box">
                            <img src="{{ asset('storage/' . $section['image']) }}" alt="{{ $section['title'] ?? 'Section Image' }}" />
                        </div>
                        <div class="fitShine-text-box">
                            <div class="text-fitShine">
                                @if(!empty($section['title']))
                                    <h2>{{ $section['title'] }}</h2>
                                @endif
                                <div>{!! $section['text'] !!}</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="statementMainSection">
                        <div class="statementBorderSection">
                            <div class="rectangleImageSection">
                                <img src="{{ asset('storage/' . $section['image']) }}" alt="{{ $section['title'] ?? 'Section Image' }}" class="rectangleImage" />
                            </div>
                            <div class="statementTextSection">
                                @if(!empty($section['title']))
                                    <div class="rectangleSectionHeading">{{ $section['title'] }}</div>
                                @endif
                                <div class="rectangleSectionDescription">
                                    {!! $section['text'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @endif
@endsection

@push('scripts')
    @vite(['resources/css/blog-page2.css', 'resources/css/ProjectDetails.css'])
@endpush

