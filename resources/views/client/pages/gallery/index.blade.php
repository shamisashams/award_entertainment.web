@extends('client.layout.site')
@section('subhead')
    <title>@lang('client.home_meta_title')</title>
    <meta name="description"
          content="@lang('client.home_meta_description')">
@endsection
@section("body_class", "vertical")
{{--@section("our_blogs")--}}
{{--    <div class="the_page_title m5" id="gallery_title">@lang("client.our_galleries_go_back")</div>--}}
{{--@endsection--}}
@section('wrapper')

    <section class="gallery_page" id="really_gallery_page">
        <div class="gallery_grid_sec2 gallery_page_grid">
            @foreach($galleries as $gallery)
                <a href="{{ locale_route('client.gallery.show', $gallery->id) }}" class="{{$loop->index % 3 == 0  ? "large" : ""}}">
                    <div class="gallery_box open_gallery_details" id="{{ $gallery->id }}">
                        @if($gallery->video_link)
                            <div class="img_overlay video">
                                <iframe
                                    width="560"
                                    height="315"
                                    src="https://www.youtube.com/embed/{{ $gallery->video_link }}"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        @elseif(count($gallery->files)>0)
                            <div class="img_overlay">
                                <img src="{{ asset($gallery->files[0]->path."/".$gallery->files[0]->title) }}" alt=""
                                     id="img_gallery_{{ $gallery->id }}"/>
                            </div>
                        @endif
                        <div class="caption">
                            {{ count($gallery->availableLanguage) >0 ? $gallery->availableLanguage[0]->title : "" }}
                            <br/><span>{{ count($gallery->availableLanguage) >0 ? $gallery->availableLanguage[0]->short_description : "" }}</span>
                        </div>
                        <p hidden id="content_1_gallery_{{ $gallery->id }}">{{ count($gallery->availableLanguage) >0 ? $gallery->availableLanguage[0]->content : "" }}</p>
                        <p hidden id="content_2_gallery_{{ $gallery->id }}">{{ count($gallery->availableLanguage) >0 ? $gallery->availableLanguage[0]->content_2 : "" }}</p>
                        <input type="text" hidden value="{{ $gallery->files }}" name=""
                               id="images_gallery_{{ $gallery->id }}">
                        <input type="text" hidden value="{{ count($gallery->availableLanguage) >0 ? $gallery->availableLanguage[0]->title : "" }}" name=""
                               id="title_gallery_{{ $gallery->id }}">
                        <input type="text" hidden value="{{ $gallery->video_link }}" name=""
                               id="video_gallery_{{ $gallery->id }}">

                    </div>
                </a>
            @endforeach

        </div>
        {{ $galleries->appends(request()->input())->links('client.pagination') }}

    </section>

{{--    <div class="fixed_frame vertical">--}}
{{--        <div class="left_logos flex">--}}
{{--            <a href="#" class="ll"><img src="/img/logo/2.png" alt=""/></a>--}}
{{--            <a href="#" class="ll"><img src="/img/logo/3.png" alt=""/></a>--}}
{{--            <a href="#" class="ll"><img src="/img/logo/4.png" alt=""/></a>--}}
{{--            <a href="#" class="ll"><img src="/img/logo/5.png" alt=""/></a>--}}
{{--            <a href="#" class="ll"><img src="/img/logo/6.png" alt=""/></a>--}}
{{--        </div>--}}
{{--        <div class="right_div"></div>--}}
{{--        <button id="footer_btn">--}}
{{--            <span></span>--}}
{{--            <svg--}}
{{--                id="Layer_2"--}}
{{--                data-name="Layer 2"--}}
{{--                xmlns="http://www.w3.org/2000/svg"--}}
{{--                width="24"--}}
{{--                height="24"--}}
{{--                viewBox="0 0 24 24"--}}
{{--            >--}}
{{--                <g id="person">--}}
{{--                    <rect--}}
{{--                        id="Rectangle_224"--}}
{{--                        data-name="Rectangle 224"--}}
{{--                        width="24"--}}
{{--                        height="24"--}}
{{--                        opacity="0"--}}
{{--                    />--}}
{{--                    <path--}}
{{--                        id="Path_1262"--}}
{{--                        data-name="Path 1262"--}}
{{--                        d="M12,11A4,4,0,1,0,8,7,4,4,0,0,0,12,11Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,5Z"--}}
{{--                    />--}}
{{--                    <path--}}
{{--                        id="Path_1263"--}}
{{--                        data-name="Path 1263"--}}
{{--                        d="M12,13a7,7,0,0,0-7,7,1,1,0,0,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,7,7,0,0,0-7-7Z"--}}
{{--                    />--}}
{{--                </g>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--        <div--}}
{{--            class="outer_wrapper gallery_outer_wrapper gallery"--}}
{{--            id="container"--}}
{{--            data-js="main-wrapper"--}}
{{--        >--}}


{{--        </div>--}}
{{--    </div>--}}
@endsection
