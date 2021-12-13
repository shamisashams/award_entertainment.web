@extends('client.layout.site')
@section('subhead')
    <title>@lang('client.home_meta_title')</title>
    <meta name="description"
          content="@lang('client.home_meta_description')">
@endsection
@section('wrapper')
    <section class="gallery_page about_us_page">
        <div class="flex first">
            {{--        <div class="img"><img src="/img/about/4.png" alt="" /></div>--}}
            @if(count($page->files)>0)
                <div class="img">
                    <img src="{{ asset($page->files[0]->path."/".$page->files[0]->title) }}"
                         alt="{{$page->files[0]->title}}"/>
                </div>
            @endif
            <div class="txt">
                <div class="title">
                    {{ count($page->availableLanguage) >0 ? $page->availableLanguage[0]->title : "" }}

                </div>
                <div class="paragraph">
                    {!! count($page->availableLanguage) >0 ? $page->availableLanguage[0]->content_1 : "" !!}
                </div>
            </div>
        </div>
        <div class="flex second">
            <div class="txt">
                <div class="paragraph">
                    {!! count($page->availableLanguage) >0 ? $page->availableLanguage[0]->content_2 : "" !!}
                </div>

            </div>
            @if(count($page->files)>1)
                <div class="img">
                    <img src="{{ asset($page->files[1]->path."/".$page->files[1]->title) }}"
                         alt="{{$page->files[1]->title}}"/>
                </div>
            @endif
        </div>
        <div class="pdf_btns flex">
            @foreach($page->company[0]->documents as $document)
                @if($document->pdf)
                    <a href="/{{$document->pdf->path.'/'.$document->pdf->title}}" target="_blank">
                        <img src="/img/icons/other/pdf.png" alt="">
                        <p> {{ count($document->availableLanguage) >0 ? $document->availableLanguage[0]->title : "" }} </p>
                        @lang('client.download_pdf')
                    </a>
                @endif
            @endforeach
        </div>
    </section>
    <div class="fixed_frame vertical">
        <div class="left_logos flex">
            <a href="#" class="ll"><img src="/img/logo/2.png" alt=""/></a>
            <a href="#" class="ll"><img src="/img/logo/3.png" alt=""/></a>
            <a href="#" class="ll"><img src="/img/logo/4.png" alt=""/></a>
            <a href="#" class="ll"><img src="/img/logo/5.png" alt=""/></a>
            <a href="#" class="ll"><img src="/img/logo/6.png" alt=""/></a>
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
    </div>
@endsection
