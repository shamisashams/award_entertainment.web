<div class="header flex @yield("body_class")">
    @yield("our_blogs")
<!-- {{--    <div class="the_page_title" id="gallery_title">Our Galleries</div>--}} -->

    {{--    @yield("miniheader")--}}
    <div class="logo flex ">
        <img src="/img/logo/1.png" alt="" />    </div>
    <div class="navbar">
        <a href="{{ locale_route("home.index") }}" class="nav {{ request()->routeIs("home.index") ? "active" : "" }}">@lang("client.home_navigation")</a>
        <a href="{{ locale_route("client.gallery.index") }}" class="nav {{ request()->routeIs("client.gallery.index") || request()->routeIs('client.gallery.show') ? "active" : "" }}">@lang("client.gallery_navigation")</a>
        <a href="{{ locale_route('client.blog.index') }}" class="nav {{ request()->routeIs("client.blog.index") ? "active" : "" }}">@lang("client.blog_navigation")</a>
        <a href="{{ locale_route("about") }}" class="nav {{ request()->routeIs("about") ? "active" : "" }}">@lang("client.about_us_navigation")</a>
        <a href="{{locale_route("home.index")."/#contact_section"}}" class="nav">@lang("client.contact_us_navigation")</a>
    </div>
    <div id="nav_menu"></div>
    <!-- <div class="social_media flex center">
        <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="9.59" height="17.906" viewBox="0 0 9.59 17.906"><path id="Icon_awesome-facebook-f" data-name="Icon awesome-facebook-f" d="M10.571,10.072l.5-3.241H7.959v-2.1A1.62,1.62,0,0,1,9.786,2.978H11.2V.219A17.238,17.238,0,0,0,8.69,0C6.13,0,4.456,1.552,4.456,4.362v2.47H1.609v3.241H4.456v7.834h3.5V10.072Z" transform="translate(-1.609)"></path></svg>
        </a>
        <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="18.602" height="18.597" viewBox="0 0 18.602 18.597"><path id="Icon_awesome-instagram" data-name="Icon awesome-instagram" d="M9.3,6.768a4.768,4.768,0,1,0,4.768,4.768A4.761,4.761,0,0,0,9.3,6.768Zm0,7.868a3.1,3.1,0,1,1,3.1-3.1,3.106,3.106,0,0,1-3.1,3.1Zm6.075-8.063a1.112,1.112,0,1,1-1.112-1.112A1.11,1.11,0,0,1,15.373,6.573ZM18.531,7.7a5.5,5.5,0,0,0-1.5-3.9,5.54,5.54,0,0,0-3.9-1.5c-1.535-.087-6.138-.087-7.673,0a5.532,5.532,0,0,0-3.9,1.5A5.522,5.522,0,0,0,.06,7.7c-.087,1.535-.087,6.138,0,7.673a5.5,5.5,0,0,0,1.5,3.9,5.547,5.547,0,0,0,3.9,1.5c1.535.087,6.138.087,7.673,0a5.5,5.5,0,0,0,3.9-1.5,5.54,5.54,0,0,0,1.5-3.9c.087-1.535.087-6.133,0-7.669Zm-1.984,9.316a3.138,3.138,0,0,1-1.768,1.768c-1.224.486-4.129.373-5.482.373s-4.262.108-5.482-.373a3.138,3.138,0,0,1-1.768-1.768c-.486-1.224-.373-4.129-.373-5.482s-.108-4.262.373-5.482A3.138,3.138,0,0,1,3.816,4.287C5.04,3.8,7.945,3.913,9.3,3.913s4.262-.108,5.482.373a3.138,3.138,0,0,1,1.768,1.768c.486,1.224.373,4.129.373,5.482S17.033,15.8,16.547,17.018Z" transform="translate(0.005 -2.238)"></path></svg>
        </a>
        <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="18.602" height="18.597" viewBox="0 0 14.684 14.684"><path id="Icon_awesome-linkedin-in" data-name="Icon awesome-linkedin-in" d="M3.287,14.684H.243v-9.8H3.287ZM1.763,3.544a1.771,1.771,0,1,1,1.763-1.78A1.778,1.778,0,0,1,1.763,3.544ZM14.681,14.684H11.643V9.912c0-1.137-.023-2.6-1.583-2.6-1.583,0-1.825,1.236-1.825,2.514v4.854H5.194v-9.8h2.92V6.218h.043a3.2,3.2,0,0,1,2.88-1.583c3.081,0,3.647,2.029,3.647,4.664v5.385Z" transform="translate(0 -0.001)"></path></svg>
        </a>
    </div> -->
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
