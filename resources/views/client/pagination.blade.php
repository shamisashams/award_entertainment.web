@if($paginator->hasPages())
        <ul class="pagination flex center">
            @if ($paginator->onFirstPage())
                <a href="" onclick="return false;">
                    <button class="flex center arrows">
                        <img src="/img/icons/pagination/1.png" alt=""/>
                    </button>

                </a>
                <a href="" onclick="return false;">
                    <button class="flex center arrows">
                        <img src="/img/icons/pagination/2.png" alt=""/>
                    </button>

                </a>
            @else
                <a href="{{ $paginator->toArray()['first_page_url'] }}">
                    <button class="flex center arrows">
                        <img src="/img/icons/pagination/1.png" alt=""/>
                    </button>

                </a>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <button class="flex center arrows">
                        <img src="/img/icons/pagination/2.png" alt=""/>
                    </button>

                </a>
{{--                <button class="flex center arrows">--}}
{{--                    <img src="/img/icons/pagination/2.png" alt=""/>--}}
{{--                </button>--}}
            @endif
{{--             Pagination Elements--}}
            @foreach ($elements as $element)
{{--                 Array Of Links--}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class=" num active"><a href="" onclick="return false;">{{$page}}</a></button>

                        @else
                            <button class="num"><a href="{{$url}}">{{$page}}</a></button>

                        @endif
                    @endforeach
                @endif
            @endforeach
{{--             Next Page Link--}}
            @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <button class="flex center arrows">
                            <img src="/img/icons/pagination/3.png" alt=""/>
                        </button>
                    </a>
                    <a href="{{ $paginator->toArray()['last_page_url'] }}">
                        <button class="flex center arrows">
                            <img src="/img/icons/pagination/4.png" alt=""/>
                        </button>
                    </a>
            @else
                    <a href="" onclick="return false;">
                        <button class="flex center arrows">
                            <img src="/img/icons/pagination/3.png" alt=""/>
                        </button>

                    </a>
                    <a href="" onclick="return false;">
                        <button class="flex center arrows">
                            <img src="/img/icons/pagination/4.png" alt=""/>
                        </button>

                    </a>

            @endif
        </ul>
@else

        <ul class="pagination flex center">
            <button class="flex center arrows">
                <img src="/img/icons/pagination/2.png" onclick="return false;" alt=""/>
            </button>
            <button class=" num active"><a href="" onclick="return false;">1</a></button>
            <button class="flex center arrows" onclick="return false;">
                <img src="/img/icons/pagination/3.png" alt=""/>
            </button>

            </a>
        </ul>
@endif
{{--<div class="pagination flex center">--}}
{{--                <button class="flex center arrows">--}}
{{--                    <img src="/img/icons/pagination/1.png" alt=""/>--}}
{{--                </button>--}}
{{--                <button class="flex center arrows">--}}
{{--                    <img src="/img/icons/pagination/2.png" alt=""/>--}}
{{--                </button>--}}
{{--                <button class="num active">1</button>--}}
{{--                <button class="num">2</button>--}}
{{--                <button class="num">3</button>--}}
{{--                <button class="num">4</button>--}}
{{--                <button class="flex center arrows">--}}
{{--                    <img src="/img/icons/pagination/3.png" alt=""/>--}}
{{--                </button>--}}
{{--                <button class="flex center arrows">--}}
{{--                    <img src="/img/icons/pagination/4.png" alt=""/>--}}
{{--                </button>--}}
{{--</div>--}}
