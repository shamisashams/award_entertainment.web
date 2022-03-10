<div class="header flex @yield("body_class")">
    @yield("our_blogs")
<!-- {{--    <div class="the_page_title" id="gallery_title">Our Galleries</div>--}} -->

    {{--    @yield("miniheader")--}}
    <a href="{{ locale_route("home.index") }}" class="logo flex " id="logo_link">
        <img src="/img/logo/1.png" alt="" />    </a>
    <div class="navbar">
        <a href="{{ locale_route("home.index") }}" class="nav {{ request()->routeIs("home.index") ? "active" : "" }}">@lang("client.home_navigation")</a>
        <a href="{{ locale_route("client.gallery.index") }}" class="nav {{ request()->routeIs("client.gallery.index") || request()->routeIs('client.gallery.show') ? "active" : "" }}">@lang("client.gallery_navigation")</a>
        <a href="{{ locale_route('client.blog.index') }}" class="nav {{ request()->routeIs("client.blog.index") ? "active" : "" }}">@lang("client.blog_navigation")</a>
        <a href="{{ locale_route("about") }}" class="nav {{ request()->routeIs("about") ? "active" : "" }}">@lang("client.about_us_navigation")</a>
        <a href="{{locale_route("home.index")."/#contact_section"}}" class="nav">@lang("client.contact_us_navigation")</a>
    </div>
    <div id="nav_menu"></div>
    <div class="social_media flex center">
        @if(request()->routeIs("client.company.show") || request()->routeIs("client.company.about"))
            @if(count($currentCompany->availableLanguage) >0 && $currentCompany->availableLanguage[0]->facebook)
                <a href="{{count($currentCompany->availableLanguage) >0 ? $currentCompany->availableLanguage[0]->facebook : ""}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.59" height="17.906" viewBox="0 0 9.59 17.906">
                        <path id="Icon_awesome-facebook-f" data-name="Icon awesome-facebook-f"
                              d="M10.571,10.072l.5-3.241H7.959v-2.1A1.62,1.62,0,0,1,9.786,2.978H11.2V.219A17.238,17.238,0,0,0,8.69,0C6.13,0,4.456,1.552,4.456,4.362v2.47H1.609v3.241H4.456v7.834h3.5V10.072Z"
                              transform="translate(-1.609)"></path>
                    </svg>
                </a>
            @endif
            @if(count($currentCompany->availableLanguage) >0 && $currentCompany->availableLanguage[0]->linkedin)
                <a href="{{count($currentCompany->availableLanguage) >0 ? $currentCompany->availableLanguage[0]->linkedin : ""}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.602" height="18.597" viewBox="0 0 14.684 14.684">
                        <path id="Icon_awesome-linkedin-in" data-name="Icon awesome-linkedin-in"
                              d="M3.287,14.684H.243v-9.8H3.287ZM1.763,3.544a1.771,1.771,0,1,1,1.763-1.78A1.778,1.778,0,0,1,1.763,3.544ZM14.681,14.684H11.643V9.912c0-1.137-.023-2.6-1.583-2.6-1.583,0-1.825,1.236-1.825,2.514v4.854H5.194v-9.8h2.92V6.218h.043a3.2,3.2,0,0,1,2.88-1.583c3.081,0,3.647,2.029,3.647,4.664v5.385Z"
                              transform="translate(0 -0.001)"></path>
                    </svg>
                </a>
            @endif
        @else
            @if(count($gfacebook->availableLanguage) > 0)
                <a href="{{ $gfacebook->availableLanguage[0]->value }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.59" height="17.906" viewBox="0 0 9.59 17.906">
                        <path id="Icon_awesome-facebook-f" data-name="Icon awesome-facebook-f"
                              d="M10.571,10.072l.5-3.241H7.959v-2.1A1.62,1.62,0,0,1,9.786,2.978H11.2V.219A17.238,17.238,0,0,0,8.69,0C6.13,0,4.456,1.552,4.456,4.362v2.47H1.609v3.241H4.456v7.834h3.5V10.072Z"
                              transform="translate(-1.609)"></path>
                    </svg>
                </a>
            @endif
            @if(count($glinkedin->availableLanguage) > 0)
                <a href="{{ $glinkedin->availableLanguage[0]->value }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.602" height="18.597" viewBox="0 0 14.684 14.684">
                        <path id="Icon_awesome-linkedin-in" data-name="Icon awesome-linkedin-in"
                              d="M3.287,14.684H.243v-9.8H3.287ZM1.763,3.544a1.771,1.771,0,1,1,1.763-1.78A1.778,1.778,0,0,1,1.763,3.544ZM14.681,14.684H11.643V9.912c0-1.137-.023-2.6-1.583-2.6-1.583,0-1.825,1.236-1.825,2.514v4.854H5.194v-9.8h2.92V6.218h.043a3.2,3.2,0,0,1,2.88-1.583c3.081,0,3.647,2.029,3.647,4.664v5.385Z"
                              transform="translate(0 -0.001)"></path>
                    </svg>
                </a>
            @endif
        @endif


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
</div>

{{--<div class="left_logos flex">--}}
            {{-- <a href="#" class="ll each_left_logo"><img src="/img/logo/2.png" alt=""/>
                <div class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit aspernatur quod dolores harum! Temporibus distinctio, expedita assumenda quidem eos atque harum obcaecati omnis eaque iste nobis, vero illum dignissimos iusto debitis eum dolores maxime doloremque fugit! Modi, delectus ex. Voluptatem?</div>
            </a>--}}
            {{-- <a href="#" class="ll each_left_logo"><img src="/img/logo/3.png" alt=""/>
                <div class="description">Lorem i eum dolores maxime doloremque fugit! Modi, delectus ex. Voluptatem?</div>
            </a>--}}
            {{-- <a href="#" class="ll each_left_logo"><img src="/img/logo/4.png" alt=""/>
                <div class="description">Lorem ipsum, dolor sit amet consectetm dolores maxime doloremque fugit! Modi, delectus ex. Voluptatem?</div>
            </a>--}}
            {{-- <a href="#" class="ll each_left_logo"><img src="/img/logo/5.png" alt=""/>
                <div class="description">Lorem ipsum, dolor sit amet consectetur adipisi cing elit. stylest ylesty lestyle styles tylestyle styl estyles tyles tylestyl estyle styl est yle styles tyleS uscipit aspernatur quod dolores harum! Temporibus distinctio, expedita assumenda  quidem eos atque harum obcaecati omnis eaque iste nobis, vero illum dignissimos iusto debitis eum dolores maxime doloremque fugit! Modi, delectus ex. Voluptatem?</div>
            </a>--}}
            {{-- <a href="#" class="ll each_left_logo"><img src="/img/logo/6.png" alt=""/>
                <div class="description">Lorebitis eum dolores maxime doloremque fugit! Modi, delectus ex. Voluptatem?</div>
            </a>--}}
{{--</div>--}}
{{--<div class="right_div"></div>--}}
