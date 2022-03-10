@extends('client.layout.site')
@section('subhead')
    <title>@lang('client.home_meta_title')</title>
    <meta name="description"
          content="@lang('client.home_meta_description')">
@endsection
@section('wrapper')

    <div class="fixed_frame">
        <div class="outer_wrapper main_pages" id="container" data-js="main-wrapper">
            <div class="wrapper">
                <section class="section one" id="first_section">
                    <div class="content flex">
                        <div class="left left_side">
                            <div class="main_titles">
                                @lang('client.we_create_great_place')
                            </div>
                            <div class="paragraph">
                                @lang("client.home_page_text")
                            </div>
                            <div class="numbers flex">
                                <div class="flex">
                                    <div class="large">@lang("client.experience_number_1")</div>
                                    <div class="t">
                                        @lang("client.experience_text_1")
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="large">@lang("client.experience_number_2")</div>
                                    <div class="t">
                                        @lang("client.experience_text_2")
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="large">@lang("client.experience_number_3")</div>
                                    <div class="t">
                                        @lang("client.experience_text_3")
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right right_side">
                            <div class="sec1_img">
                                <div class="sec1_img_slider">
                                    @foreach($sliders as $slider)
                                        @if(count($slider->files)>0)
                                            <div class="slider_item">
                                                <img
                                                    src="{{ asset($slider->files[0]->path."/".$slider->files[0]->title) }}"
                                                    alt=""/>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{--                                <div class="slider_item">--}}
                                    {{--                                    <img src="img/sec1/2.png" alt="" />--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="slider_item">--}}
                                    {{--                                    <img src="img/gallery/6.png" alt="" />--}}
                                    {{--                                </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section two other_sections" id="gallery_section">
                    <div class="content flex">
                        <div class="left left_side">
                            <div class="main_titles">
                                @lang("client.our_gallery")
                                <div class="sub_title">
                                    @lang("client.gallery_desc")
                                </div>
                            </div>
                            <div class="flex quote">
                                <div class="quotes"><img src="img/sec2/2.png" alt=""/></div>
                                <div class="paragraph">
                                    @lang("client.gallery_text")
                                </div>
                            </div>
                            <a href="{{ locale_route("client.gallery.index") }}">
                                <div class="view_all">
                                    <div class="paragraph">
                                        @lang("client.view_all_gallery")
                                        <span class="arrow"
                                        ><img src="/img/icons/arrows/1.png" alt=""
                                            /></span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="right right_side">

                            @if(count($page->files)>0)
                                <div class="circle">
                                    <div class="img">
                                        <img src="{{ asset($page->files[0]->path."/".$page->files[0]->title) }}"
                                             alt="{{$page->files[0]->title}}"/>
                                    </div>
                                </div>
                            @endif
                            <div class="scroll_overflow">
                                <div class="gallery_grid_sec2">
                                    @foreach($galleries as $gallery)
                                        <a href="{{ locale_route('client.gallery.show', $gallery->id) }}"
                                           class="{{in_array($loop->index, [0,7])  ? "large" : ""}}">
                                            <div class="gallery_box" id="{{ $gallery->id }}">
                                                @if($gallery->mainFile)
                                                    <div class="img_overlay">
                                                        <img id="img_gallery_{{ $gallery->id }}"
                                                             src="{{ asset($gallery->mainFile->path."/".$gallery->mainFile->title) }}"
                                                             alt=""/>
                                                    </div>
                                                @endif
                                                <div class="caption">
                                                    @if(count($gallery->availableLanguage) >0)
                                                        {{ $gallery->availableLanguage[0]->title }}
                                                        <br/>
                                                        <span>{{ $gallery->availableLanguage[0]->short_description }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <p hidden
                                               id="content_1_gallery_{{ $gallery->id }}">{{ count($gallery->availableLanguage) >0? $gallery->availableLanguage[0]->content : "" }}</p>
                                            <p hidden
                                               id="content_2_gallery_{{ $gallery->id }}">{{count($gallery->availableLanguage) >0? $gallery->availableLanguage[0]->content_2 : "" }}</p>
                                            <input type="text" hidden value="{{ $gallery->files }}" name=""
                                                   id="images_gallery_{{ $gallery->id }}">
                                            <input type="text" hidden
                                                   value=" {{ count($gallery->availableLanguage) >0?  $gallery->availableLanguage[0]->title : "" }}"
                                                   name="" id="title_gallery_{{ $gallery->id }}">
                                            <input type="text" hidden
                                                   value="{{ $gallery->video_link }}"
                                                   name="" id="video_gallery_{{ $gallery->id }}">


                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section three other_sections" id="blog_section">
                    <div class="content flex">
                        <div class="left left_side">
                            <div class="main_titles">
                                @lang("client.our_blog")
                                <div class="sub_title">
                                    @lang("client.blog_desc")

                                </div>
                            </div>
                            <div class="flex quote">
                                <div class="quotes"><img src="img/sec2/2.png" alt=""/></div>
                                <div class="paragraph">
                                    @lang("client.blog_text")
                                </div>
                            </div>
                            <a href="{{ locale_route('client.blog.index') }}">
                                <div class="view_all">
                                    <div class="paragraph">
                                        @lang("client.view_all_blogs")
                                        <span class="arrow"
                                        ><img src="img/icons/arrows/1.png" alt=""
                                            /></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="right right_side">
                            <div class="scroll_overflow">
                                <div class="blog_grid_sec3">
                                    @foreach($blogs as $blog)
                                        <div class="blog_box flex">
                                            @if(count($blog->files)>0)
                                                <div class="img">
                                                    <img id="img_blog_{{ $blog->id }}"
                                                         src="{{ asset($blog->files[0]->path."/".$blog->files[0]->title) }}"
                                                         alt="{{ $blog->files[0]->title }}"/>
                                                </div>
                                            @endif
                                            <div class="context">
                                                {{--                                        @if(count($blog->languages)>0)--}}
                                                <div class="title" id="title_blog_{{ $blog->id }}">
                                                    {{--                                                    {{ $blog->language(app()->getLocale())->title ? $blog->language(app()->getLocale())->title : $blog->language()->title}}--}}
                                                    {{ count($blog->availableLanguage) >0 ? $blog->availableLanguage[0]->title : "" }}
                                                </div>
                                                {{--                                            @endif--}}
                                                <div class="flex info">
                                                    <div class="flex">
                                                        <img src="/img/icons/blog/1.png" alt=""/>
                                                        <div
                                                            id="location_blog_{{ $blog->id }}">{{ count($blog->availableLanguage) >0 ? ucfirst($blog->availableLanguage[0]->city) : "" }}
                                                            , {{ count($blog->availableLanguage) >0 ? ucfirst($blog->availableLanguage[0]->country) : "" }}</div>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="/img/icons/blog/2.png" alt=""/>
                                                        <div
                                                            id="date_blog_{{ $blog->id }}">{{ $blog->created_at->format('d/m/Y') }}</div>
                                                    </div>
                                                </div>
                                                {{--                                                @if(count($blog->languages)>0)--}}
                                                <div class="para">
                                                    {{--                                                @dd($blog->languages[0]->description)--}}
                                                    {{ count($blog->availableLanguage) >0 ? $blog->availableLanguage[0]->short_description : "" }}
                                                </div>
                                                {{--                                                @endif--}}
                                                <a href="#">
                                                    <div class="flex view_more open_gallery_details"
                                                         id="{{ $blog->id }}">
                                                        <div>@lang("client.view_more_blog")</div>
                                                        <img src="/img/icons/blog/3.png" alt=""/>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div hidden
                                             id="content_blog_{{ $blog->id }}">{{ count($blog->availableLanguage) >0 ? $blog->availableLanguage[0]->content : "" }}</div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section four other_sections" id="about_section">
                    <div class="content flex">
                        <div class="left left_side">
                            <div class="main_titles">
                                @lang("client.about_us")

                                <div class="sub_title">
                                    @lang("client.about_us_desc")

                                </div>
                            </div>
                            <div class="flex quote">
                                <div class="quotes"><img src="img/sec2/2.png" alt=""/></div>
                                <div class="paragraph">
                                    @lang("client.about_us_text")

                                </div>
                            </div>
                            <a href="{{ locale_route("about") }}">
                                <div class="view_all">
                                    <div class="paragraph">
                                        @lang("client.about_us_view_all")
                                        <span class="arrow"
                                        ><img src="img/icons/arrows/1.png" alt=""
                                            /></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="right right_side">
                            <div class="about_section">
                                <div class="flex">
                                    @if(count($page->files)>1)
                                        <div class="img">
                                            <img src="{{ asset($page->files[1]->path."/".$page->files[1]->title) }}"
                                                 alt="{{$page->files[1]->title}}"/>
                                        </div>
                                    @endif
                                    <div class="text">
                                        <div class="title">
                                            {{ count($page->availableLanguage) >0 ? $page->availableLanguage[0]->title : "" }}
                                        </div>
                                        <div class="paragraph">
                                            {!! count($page->availableLanguage) >0 ? $page->availableLanguage[0]->content_1 : "" !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex two">
                                    <div class="text">
                                        <div class="paragraph">
                                            {!! count($page->availableLanguage) >0 ? $page->availableLanguage[0]->content_2 : "" !!}

                                        </div>
                                    </div>
                                    @if(count($page->files)>2)
                                        <div class="img">
                                            <img src="{{ asset($page->files[2]->path."/".$page->files[2]->title) }}"
                                                 alt="{{$page->files[2]->title}}"/>
                                        </div>
                                    @endif                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section five other_sections" id="contact_section">
                    <div class="content flex">
                        <div class="left left_side">
                            <div class="main_titles">
                                @lang("client.contact_us")
                            </div>
                            <div class="paragraph">
                                @lang("client.contact_us_text")

                            </div>
                            <form class="form" method="POST" action="{{locale_route('contact.index')}}">
                                @csrf
                                <input type="text " placeholder="Name" name="name"/>
                                <input type="text " placeholder="Email" name="mail"/>
                                <textarea name="message" placeholder="Type a message..."></textarea>
                                <button class="send_message flex">
                                    <div>@lang("client.contact_us_send_message")</div>
                                    <img src="/img/icons/arrows/1.png" alt=""/>
                                </button>
                            </form>
                            {{--                            <div class="form">--}}
                            {{--                                <input type="text " placeholder="Name"/>--}}
                            {{--                                <input type="text " placeholder="Name"/>--}}
                            {{--                                <textarea placeholder="Type a message..."></textarea>--}}
                            {{--                            </div>--}}
                            {{--                            <button class="send_message flex">--}}
                            {{--                                <div>Send Messages</div>--}}
                            {{--                                <img src="img/icons/arrows/1.png" alt=""/>--}}
                            {{--                            </button>--}}
                        </div>
                        <div class="right right_side">
                            <div class="contact_section">
                                <div class="title"><strong>@lang("client.informations")</strong></div>
                                <div class="map">
                                    <iframe
                                        src="//www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d186.17928570486754!2d44.798402263692886!3d41.701772867395775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440cddef57a6c5%3A0xb94ab8928852f52f!2s6%20Mari%20Brose%20Street%2C%20T&#39;bilisi!5e0!3m2!1sen!2sge!4v1632310509044!5m2!1sen!2sge"
                                        width="600"
                                        height="450"
                                        style="border: 0"
                                        allowfullscreen=""
                                        loading="lazy"
                                    ></iframe>
                                </div>

                                <div class="contact_info flex">
                                    <div class="column" style="margin-right: 5px">
                                        @if(count($gcity->availableLanguage) > 0)
                                            <div class="title">{{ $gcity->availableLanguage[0]->value }}</div>
                                        @endif
                                        <div class="flex">
                                            <div style="margin-right: 16px">
                                                <strong style="color: #235164; font-size: 12px"
                                                >@lang("client.address")</strong
                                                >
                                                @if(count($gaddress->availableLanguage) > 0)
                                                    <div class="para">
                                                        {{ $gaddress->availableLanguage[0]->value }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div style="margin-right: 16px">
                                                <strong style="color: #235164; font-size: 12px"
                                                >@lang("client.phone_number")</strong
                                                >
                                                @if(count($gphone->availableLanguage) > 0)
                                                    <div class="para">{{ $gphone->availableLanguage[0]->value }}</div>
                                                @endif
                                            </div>
                                            <div>
                                                <strong style="color: #235164; font-size: 12px"
                                                >@lang("client.email_address")</strong
                                                >
                                                @if(count($gemail->availableLanguage) > 0)
                                                    <div class="para"><a
                                                            href="mailto:{{ $gemail->availableLanguage[0]->value }}">{{ $gemail->availableLanguage[0]->value }}</a>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    {{--                                    <div class="column" style="margin-right: 5px">--}}
                                    {{--                                        @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                            <div class="title">{{ $gcity->availableLanguage[0]->value }}</div>--}}
                                    {{--                                        @endif--}}
                                    {{--                                            <div style="margin-bottom: 10px">--}}
                                    {{--                                            <strong style="color: #235164; font-size: 12px"--}}
                                    {{--                                            >@lang("client.address")</strong--}}
                                    {{--                                            >--}}
                                    {{--                                            @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                                <div class="para">--}}
                                    {{--                                                    {{ $gaddress->availableLanguage[0]->value }}--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div style="margin-bottom: 10px">--}}
                                    {{--                                            <strong style="color: #235164; font-size: 12px"--}}
                                    {{--                                            >@lang("client.phone_number")</strong--}}
                                    {{--                                            >--}}
                                    {{--                                            @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                                <div class="para">{{ $gphone->availableLanguage[0]->value }}</div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div>--}}
                                    {{--                                            <strong style="color: #235164; font-size: 12px"--}}
                                    {{--                                            >@lang("client.email_address")</strong--}}
                                    {{--                                            >--}}
                                    {{--                                            @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                                <div class="para">{{ $gemail->availableLanguage[0]->value }}</div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="column">--}}
                                    {{--                                        @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                            <div class="title">{{ $gcity->availableLanguage[0]->value }}</div>--}}
                                    {{--                                        @endif--}}
                                    {{--                                            <div style="margin-bottom: 10px">--}}
                                    {{--                                            <strong style="color: #235164; font-size: 12px"--}}
                                    {{--                                            >@lang("client.address")</strong--}}
                                    {{--                                            >--}}
                                    {{--                                            <div class="para">--}}
                                    {{--                                                @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                                    <div class="para">--}}
                                    {{--                                                        {{ $gaddress->availableLanguage[0]->value }}--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                @endif--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div style="margin-bottom: 10px">--}}
                                    {{--                                            <strong style="color: #235164; font-size: 12px"--}}
                                    {{--                                            >@lang("client.phone_number")</strong--}}
                                    {{--                                            >--}}
                                    {{--                                            <div class="para">--}}
                                    {{--                                                @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                                    <div class="para">{{ $gphone->availableLanguage[0]->value }}</div>--}}
                                    {{--                                                @endif--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div>--}}
                                    {{--                                            <strong style="color: #235164; font-size: 12px"--}}
                                    {{--                                            >@lang("client.email_address")</strong--}}
                                    {{--                                            >--}}
                                    {{--                                            <div class="para">--}}
                                    {{--                                                @if(count($gabout->availableLanguage) > 0)--}}
                                    {{--                                                    <div class="para">{{ $gemail->availableLanguage[0]->value }}</div>--}}
                                    {{--                                                @endif--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        {{--        blog wraper     --}}
        <div
            class="outer_wrapper gallery_outer_wrapper blogs"
            id="container"
            data-js="main-wrapper"
        >

        </div>

        {{--        gallery wrapper   --}}
        <div
            class="outer_wrapper gallery_outer_wrapper gallery"
            id="container"
            data-js="main-wrapper"
        >

        </div>
        <div class="left_logos flex">
            @foreach($comp as $company)
                {{--                <a href="{{ $company->company_link ?? "#" }}" class="ll each_left_logo"--}}
                {{--                   target="{{ $company->company_link ? "_blank" : "_self" }}">--}}
                {{--                    @if(count($company->files)>0)--}}
                {{--                        <img src="{{ asset($company->files[0]->path."/".$company->files[0]->title) }}"--}}
                {{--                             alt="{{$company->files[0]->titl}}"/>--}}
                {{--                    @endif--}}
                {{--                    <div class="description">--}}
                {{--                        {!!  count($company->availableLanguage) >0 ? $company->availableLanguage[0]->description : "" !!}--}}

                {{--                    </div>--}}
                {{--                </a>--}}

                <a href="#" class="ll each_left_logo">
                    @if($company->mainFile)
                        <img src="{{asset($company->mainFile->path.'/'.$company->mainFile->title)}}"
                             alt="{{$company->mainFile->title}}"/>
                    @endif
                    <div class="description">
                        {!!  count($company->availableLanguage) >0 ? $company->availableLanguage[0]->description : "" !!}
                        <button class='link'
                                onclick="window.location.href='{{locale_route('client.company.show', $company->id)}}'"
                            {{--                                href="{{locale_route('client.company.show', $company->id)}}"--}}
                        >Visit Page
                        </button>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="right_div">
            <div class="liberty">
                @lang("client.liberty")
            </div>
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
        </div>
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
    </div>
    {{--    @foreach($comp as $company)--}}

    {{--        <div class="branch_popup">--}}
    {{--            <button class="close_branch_popup"><img src="img/icons/other/close2.png" alt=""></button>--}}
    {{--            <div class="container">--}}

    {{--                <div class="bp_left">--}}
    {{--                    <div class="main_title"--}}
    {{--                         style="color: #ED1C24;">{{count($company->availableLanguage) >0 ? $company->availableLanguage[0]->content_title : ""}}</div>--}}
    {{--                    <div class="block">--}}
    {{--                        <div class="title">{{count($company->availableLanguage) >0 ? $company->availableLanguage[0]->content_sub_title_1 : ""}}</div>--}}
    {{--                        <p>--}}
    {{--                            {!!  count($company->availableLanguage) >0 ? $company->availableLanguage[0]->content_description : "" !!}--}}
    {{--                        </p>--}}

    {{--                        <div class="title" style="margin-top: 15px">{{count($company->availableLanguage) >0 ? $company->availableLanguage[0]->content_sub_title_2 : ""}}</div>--}}
    {{--                        <p>--}}
    {{--                            {!!  count($company->availableLanguage) >0 ? $company->availableLanguage[0]->content_description_2 : "" !!}--}}
    {{--                        </p>--}}

    {{--                        <div class="title" style="margin-top: 15px">{{count($company->availableLanguage) >0 ? $company->availableLanguage[0]->content_sub_title_3 : ""}}</div>--}}
    {{--                        <p>--}}
    {{--                            {!!  count($company->availableLanguage) >0 ? $company->availableLanguage[0]->content_description_3 : "" !!}--}}
    {{--                        </p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="bp_right">--}}

    {{--                    <div class="title">@lang('client.companies_gallery')</div>--}}
    {{--                    <div class="img_row">--}}
    {{--                        @foreach($company->files as $file)--}}
    {{--                            <div class="gallery_box">--}}
    {{--                                <div class="img_overlay">--}}
    {{--                                    <img src="{{ asset($file->path."/".$file->title) }}"--}}
    {{--                                         alt="{{$file->title}}"/></div>--}}
    {{--                                --}}{{--                                <div class="caption">Equipment on the account of "AWARD Transport"<br/><span>Equipment of AWARD Transport</span></div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                    <div class="title">@lang('client.download_document')</div>--}}
    {{--                    <div class="flex">--}}
    {{--                        @foreach($company->documents as $document)--}}
    {{--                            @if($document->pdf)--}}
    {{--                            <div class="document">--}}
    {{--                                <img src="/img/icons/other/pdf.png" alt="pdf_icon">--}}
    {{--                                <p>{{ count($document->availableLanguage) >0 ? $document->availableLanguage[0]->title : "" }}</p>--}}
    {{--                                <a href="/{{$document->pdf->path.'/'.$document->pdf->title}}" target="_blank">@lang('client.download_pdf')</a>--}}
    {{--                            </div>--}}
    {{--                            @endif--}}
    {{--                            @if($document->pdf)--}}
    {{--                                <a target="_blank" href="/{{$document->pdf->path.'/'.$document->pdf->title}}">--}}
    {{--                                    <div class="dl_pdf flex">--}}
    {{--                                        <img src="/client/img/icons/other/pdf.png" alt="">--}}
    {{--                                        <div>@lang('client.download_pdf')</div>--}}
    {{--                                    </div>--}}
    {{--                                </a>--}}
    {{--                            @endif--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    @endforeach--}}


@endsection
