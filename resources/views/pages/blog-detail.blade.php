@extends('layouts.app')

@section('content')
    <!-- Feature Image Banner -->
    <div class="blogBannerContainer">
        <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="{{ $blog->title }}" class="blogBannerImage" />
    </div>

    <!-- Blog Details -->
    <div class="detailsContainer">
        <div class="detailsText">
            <div class="detailsIcons">
                <img src="{{ asset('images/BLOG 5 Ways to Elevate Your Space with/SHARE.svg') }}" alt="Share" class="blogDetailsImage" />
                <div class="shareText">Share this blog</div>
                <img src="{{ asset('images/BLOG 5 Ways to Elevate Your Space with/EMAIL LOGO.svg') }}" alt="Email" class="blogDetailsImage blogMobileVanish" />
                <img src="{{ asset('images/BLOG 5 Ways to Elevate Your Space with/FACEBOOK LOGO 60.svg') }}" alt="Facebook" class="blogDetailsImage blogMobileVanish" />
                <img src="{{ asset('images/BLOG 5 Ways to Elevate Your Space with/INSTRAGRAM LOGO 60.svg') }}" alt="Instagram" class="blogDetailsImage blogMobileVanish" />
                <img src="{{ asset('images/BLOG 5 Ways to Elevate Your Space with/LINKDIN LOGO BLACK 60.svg') }}" alt="LinkedIn" class="blogDetailsImage blogMobileVanish" />
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

            @if($section['type'] === 'full_image')
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
    @vite(['resources/css/blog-page2.css'])
@endpush

