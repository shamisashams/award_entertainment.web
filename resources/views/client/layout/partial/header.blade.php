<div class="header flex @yield("body_class")">
    @yield("our_blogs")
{{--    <div class="the_page_title" id="gallery_title">Our Galleries</div>--}}

    {{--    @yield("miniheader")--}}
    <a href="/" class="logo flex ">
        <img src="/img/logo/1.png" alt="" />    </a>
    <div class="navbar">
        <a href="{{ route("home.index") }}" class="nav {{ request()->routeIs("home.index") ? "active" : "" }}">@lang("client.home_navigation")</a>
        <a href="{{ route("client.gallery.index") }}" class="nav {{ request()->routeIs("client.gallery.index") || request()->routeIs('client.gallery.show') ? "active" : "" }}">@lang("client.gallery_navigation")</a>
        <a href="{{ route('client.blog.index') }}" class="nav {{ request()->routeIs("client.blog.index") ? "active" : "" }}">@lang("client.blog_navigation")</a>
        <a href="{{ route("about") }}" class="nav {{ request()->routeIs("about") ? "active" : "" }}">@lang("client.about_us_navigation")</a>
        <a href="/#contact_section" class="nav">@lang("client.contact_us_navigation")</a>
    </div>
    <div id="nav_menu"></div>
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
