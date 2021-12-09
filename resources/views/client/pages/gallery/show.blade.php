@extends('client.layout.site')
@section('subhead')
    <title>@lang('client.home_meta_title')</title>
    <meta name="description"
          content="@lang('client.home_meta_description')">
@endsection
@section("body_class", "vertical")
@section("our_blogs")
    <!-- <div class="the_page_title m5 clicked" id="gallery_title">@lang("client.our_galleries_go_back")</div> -->
@endsection
@section('wrapper')
    <section class="gallery_page detail">
        <section class="gallery_detail gallery">
        <div class="the_page_title clicked" id="gallery_title" style="cursor: pointer;">@lang("client.our_galleries_go_back")</div>
            <!-- return btn - only  on home page -->
        {{--            <a href="{{ route('client.gallery.index') }}">--}}
        {{--                <button class="flex go_back_btn">--}}
        {{--                    <img src="/img/icons/arrows/2.png" alt=""/>--}}
        {{--                    <div>Go Back</div>--}}
        {{--                </button>--}}
        {{--            </a>--}}

        <!-------->
            @if(count($gallery->availableLanguage) >0 && $gallery->mainFile )
                <div class="flex flexes a">
                    <div class="context">
                        {{--                        <div class="title">{{ $gallery->availableLanguage[0]->title }}</div>--}}
                        <div class="paragraph">
                            {!! $gallery->availableLanguage[0]->content !!}
                        </div>
                    </div>
                    <div class="img">
                        <img src="{{ asset($gallery->mainFile->path."/".$gallery->mainFile->title) }}" alt=""/>
                    </div>
                </div>
            @endif
            @if(count($gallery->availableLanguage) >0 && $gallery->video_link)
                <div class="flex flexes b">
                    <div class="img video">
                        <iframe
                            width="560"
                            height="315"
                            src="https://www.youtube.com/embed/{{ $gallery->video_link }}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen=""
                        ></iframe>
                    </div>
                    <div class="context">
                        {{--                        <div class="title">Lorem Ipsum</div>--}}
                        <div class="paragraph">
                            {!! $gallery->availableLanguage[0]->content !!}
                        </div>
                    </div>
                </div>
            @endif
            @if(count($gallery->files) > 0)
                <div class="bottom_images">
                    <div class="flex">
                        @foreach($gallery->files as $file)
                            <div class="img open_gallery_popup">
                                <img src="{{ asset($file->path."/".$file->title) }}" alt=""/>
                            </div>
                            @if($loop->first && $gallery->video_link)
                                <div class="img video">
                                    <iframe
                                        width="560"
                                        height="315"
                                        src="https://www.youtube.com/embed/{{ $gallery->video_link }}"
                                        title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen=""
                                    ></iframe>
                                </div>
                            @endif
                        @endforeach
                        {{--                        <div class="img video">--}}
                        {{--                            <iframe--}}
                        {{--                                width="560"--}}
                        {{--                                height="315"--}}
                        {{--                                src="https://www.youtube.com/embed/LlbQU6jWPz0?modestbranding=1&amp;showinfo=0"--}}
                        {{--                                title="YouTube video player"--}}
                        {{--                                frameborder="0"--}}
                        {{--                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                        {{--                                allowfullscreen=""--}}
                        {{--                            ></iframe>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/2.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/3.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/4.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/5.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/6.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/7.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/2.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/3.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/4.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/5.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/6.png" alt=""/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="img open_gallery_popup">--}}
                        {{--                            <img src="/img/gallery/7.png" alt=""/>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            @endif
        </section>
    </section>

    <div class="fixed_frame vertical">


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
    <div class="left_logos flex" style='z-index: 190;'>
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
    <div class="gallery_popup">
        <div class="slider">
            <button class="close_popup">
                <img src="/img/icons/other/close.png" alt=""/>
            </button>
            <button class="arr" id="prev_pop">
                <img src="/img/icons/other/prev.png" alt=""/>
            </button>
            <button class="arr" id="next_pop">
                <img src="/img/icons/other/next.png" alt=""/>
            </button>
            @if(count($gallery->files) > 0)
                <div class="gallery_popup_slider">
                    @foreach($gallery->files as $file)
                        <div class="img">
                            <img src="{{ asset($file->path."/".$file->title) }}" alt=""/>
                        </div>
                        {{--                                                <div class="img">--}}
                        {{--                                                    <img src="/img/gallery/2.png" alt=""/>--}}
                        {{--                                                </div>--}}
                        @if($loop->first && $gallery->video_link)
                            <div class="img">
                                <iframe
                                    width="560"
                                    height="315"
                                    src="https://www.youtube.com/embed/{{ $gallery->video_link }}"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen=""
                                ></iframe>
                            </div>
                        @endif
                    @endforeach
                </div>
        </div>
    </div>
    @endif


@endsection
