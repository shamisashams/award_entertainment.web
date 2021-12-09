
@extends('client.layout.site')
@section('subhead')
    <title>@lang('client.home_meta_title')</title>
    <meta name="description"
          content="@lang('client.home_meta_description')">
@endsection
@section("body_class", "vertical")
@section("our_blogs")
    <!-- <div class="the_page_title m5" id="blog_title">@lang("client.our_blogs_go_back")</div> -->

@endsection
@section('wrapper')

    <section class="gallery_page blogs" id="blog_page">
    <div class="the_page_title">RAY</div>
        <div class="blog_page_grid">
            @foreach($blogs as $blog)
            <div class="blog_box flex">
                @if(count($blog->files)>0)
                    <div class="img">
                        <img src="{{ asset($blog->files[0]->path."/".$blog->files[0]->title) }}" alt="{{$blog->files[0]->title}}" id="img_{{ $blog->id }}"/>
                    </div>
                @endif
                <div class="context">
                    <div class="title" id="title_{{ $blog->id }}">
                        {{ count($blog->availableLanguage) >0 ? $blog->availableLanguage[0]->title : "" }}
                    </div>
                    <div class="flex info">
                        <div class="flex">
                            <img src="/img/icons/blog/1.png" alt=""/>
                            <div id="location_{{ $blog->id }}">{{ count($blog->availableLanguage) >0 ? ucfirst($blog->availableLanguage[0]->city) : "" }}, {{ count($blog->availableLanguage) >0 ? ucfirst($blog->availableLanguage[0]->country) : "" }}</div>                        </div>
                        <div class="flex">
                            <img src="/img/icons/blog/2.png" alt=""/>
                            <div id="date_{{ $blog->id }}">{{ $blog->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    <div class="para" id="description_{{ $blog->id }}">
                        {{ count($blog->availableLanguage) >0 ? $blog->availableLanguage[0]->short_description : "" }}
                    </div>
                    <a href="#">
                        <div class="flex view_more open_gallery_details" id="{{ $blog->id }}">
                            <div>@lang("client.view_more_blog")</div>
                            <img src="/img/icons/blog/3.png" alt=""/>
                        </div>
                    </a>
                    <div hidden id="content_{{ $blog->id }}">{{ count($blog->availableLanguage) >0 ? $blog->availableLanguage[0]->content : "" }}</div>

                </div>
            </div>
            @endforeach
        </div>
        {{ $blogs->appends(request()->input())->links('client.pagination') }}

    </section>
    <div class="fixed_frame vertical">
        <div class="left_logos flex">
            <a href="#" class="ll"><img src="/img/logo/2.png" alt="" /></a>
            <a href="#" class="ll"><img src="/img/logo/3.png" alt="" /></a>
            <a href="#" class="ll"><img src="/img/logo/4.png" alt="" /></a>
            <a href="#" class="ll"><img src="/img/logo/5.png" alt="" /></a>
            <a href="#" class="ll"><img src="/img/logo/6.png" alt="" /></a>
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
        <div class="outer_wrapper gallery_outer_wrapper blogs" id="container" data-js="main-wrapper">

        </div>
    </div>
@endsection
