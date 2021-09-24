@if(! (request()->routeIs("home.index") || request()->routeIs("client.gallery.show")))
    <div class="fixed_frame vertical">
        <div class="left_logos flex">
            @foreach($companies as $company)
                <a href="{{ $company->company_link ?? "#" }}" class="ll each_left_logo"
                   target="{{ $company->company_link ? "_blank" : "_self" }}">
                    @if(count($company->files)>0)
                        <img src="{{ asset($company->files[0]->path."/".$company->files[0]->title) }}"
                             alt="{{$company->files[0]->title}}"/>
                    @endif
                    <div class="description">
                        {!!  count($company->availableLanguage) >0 ? $company->availableLanguage[0]->description : "" !!}

                    </div>
                </a>

            @endforeach
        </div>
        <div class="right_div"></div>
        <button id="footer_btn">
            <span></span>
            <svg
                id="Layer_2"
                data-name="Layer 2"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
            >
                <g id="person">
                    <rect
                        id="Rectangle_224"
                        data-name="Rectangle 224"
                        width="24"
                        height="24"
                        opacity="0"
                    />
                    <path
                        id="Path_1262"
                        data-name="Path 1262"
                        d="M12,11A4,4,0,1,0,8,7,4,4,0,0,0,12,11Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,5Z"
                    />
                    <path
                        id="Path_1263"
                        data-name="Path 1263"
                        d="M12,13a7,7,0,0,0-7,7,1,1,0,0,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,7,7,0,0,0-7-7Z"
                    />
                </g>
            </svg>
        </button>
        <div
            class="outer_wrapper gallery_outer_wrapper gallery"
            id="container"
            data-js="main-wrapper"
        >


        </div>
    </div>
@endif

<a href="https://awardholding.com/ge" target="_blank" id="bottom_logo">
    <img src="/img/logo/7.png" alt=""/>
</a>
{{--<button id="footer_btn">--}}
{{--    <span></span>--}}
{{--    <svg--}}
{{--        id="Layer_2"--}}
{{--        data-name="Layer 2"--}}
{{--        xmlns="http://www.w3.org/2000/svg"--}}
{{--        width="24"--}}
{{--        height="24"--}}
{{--        viewBox="0 0 24 24"--}}
{{--    >--}}
{{--        <g id="person">--}}
{{--            <rect--}}
{{--                id="Rectangle_224"--}}
{{--                data-name="Rectangle 224"--}}
{{--                width="24"--}}
{{--                height="24"--}}
{{--                opacity="0"--}}
{{--            />--}}
{{--            <path--}}
{{--                id="Path_1262"--}}
{{--                data-name="Path 1262"--}}
{{--                d="M12,11A4,4,0,1,0,8,7,4,4,0,0,0,12,11Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,5Z"--}}
{{--            />--}}
{{--            <path--}}
{{--                id="Path_1263"--}}
{{--                data-name="Path 1263"--}}
{{--                d="M12,13a7,7,0,0,0-7,7,1,1,0,0,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,7,7,0,0,0-7-7Z"--}}
{{--            />--}}
{{--        </g>--}}
{{--    </svg>--}}
{{--</button>--}}
<div id="footer">
    <div class="flex">
        <div class="columns">
            <div class="title">@lang("client.about_us_footer")</div>
            @if(count($gabout->availableLanguage) > 0)
                <div class="text">
                    {{ $gabout->availableLanguage[0]->value }}
                </div>
            @endif
        </div>
        <div class="columns">
            <div class="title">@lang("client.links_footer")</div>
            @if(count($gfacebook->availableLanguage) > 0)
                <a href="{{ $gfacebook->availableLanguage[0]->value }}" class="text">@lang("client.facebook_footer")</a>
            @endif
            @if(count($ginstagram->availableLanguage) > 0)
                <a href="{{ $ginstagram->availableLanguage[0]->value }}"
                   class="text">@lang("client.instagram_footer")</a>
            @endif
            @if(count($gtwitter->availableLanguage) > 0)
                <a href="{{ $gtwitter->availableLanguage[0]->value }}" class="text">@lang("client.Twitter_footer")</a>
            @endif
            @if(count($gyoutube->availableLanguage) > 0)
                <a href="{{ $gyoutube->availableLanguage[0]->value }}" class="text">@lang("client.youtube_footer")</a>
            @endif
        </div>
        <div class="columns">
            <div class="title">@lang("client.contact_us_footer")</div>
            @if(count($gphone->availableLanguage) > 0)
                <a href="#" class="text">{{ $gphone->availableLanguage[0]->value }}</a>
            @endif
            @if(count($gemail->availableLanguage) > 0)
                <a href="#" class="text">{{ $gemail->availableLanguage[0]->value }}</a>
            @endif
            @if(count($gaddress->availableLanguage) > 0)
                <a href="#" class="text">{{ $gaddress->availableLanguage[0]->value }}</a>
            @endif
        </div>
        <div class="columns">
            <div class="title">@lang("client.maps_footer")</div>
            <div class="box"></div>
        </div>
        <div class="columns">
            <div class="title">@lang("client.gallery_footer")</div>
            <div class="box"></div>
        </div>
    </div>
    <div class="bottom flex">
        <button id="close_footer">
            <img src="/img/icons/footer/close.png" alt=""/>
        </button>
        <div class="text">Designed by insite</div>
    </div>
</div>

@if(isset($localizations['data']))
    <div class="languages">

        <div class="current lang">
            <img src="/img/flags/{{$localizations['current']['locale']}}.png" alt=""/>
        </div>

        <div class="drop">
            @foreach($localizations['data'] as $language)
                <a class="lang" href="{{$language['url']}}">
                    <img src="/img/flags/{{$language['locale']}}.png" alt=""/>
                </a>
            @endforeach
        </div>
    </div>

@endif
