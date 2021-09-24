{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')

{{-- page title --}}
@section('title',__('admin.about'))


@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="button-trigger" class="card card card-default scrollspy">

                <div class="card-content">
                    {{--                    <a class="btn-floating btn-large primary-text gradient-shadow compose-email-trigger "--}}
                    {{--                       href="{{locale_route('about.create')}}">--}}
                    {{--                        <i class="material-icons">add</i>--}}
                    {{--                    </a>--}}
                    <h4 class="card-title mt-2">@lang('admin.about')</h4>
                    <div class="row">
                        <div class="col s12">
                            <form class="mr-0 p-0">
                                <table id="data-table-simple" class="display">
                                    <thead>
                                    <tr>
                                        <th>@lang('admin.id')</th>
                                        <th>@lang('admin.key')</th>
                                        <th>@lang('admin.title')</th>
                                        <th>@lang('admin.action')</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <th>
                                            <input type="number" name="id" onchange="this.form.submit()"
                                                   value="{{Request::get('id')}}"
                                                   class="validate {{$errors->has('id') ? '' : 'valid'}}">
                                        </th>
                                        <th>
                                            <input type="text" name="key" onchange="this.form.submit()"
                                                   value="{{Request::get('key')}}"
                                                   class="validate {{$errors->has('key') ? '' : 'valid'}}">
                                        </th>
                                        <th>
                                            <input type="text" name="title" onchange="this.form.submit()"
                                                   value="{{Request::get('title')}}"
                                                   class="validate {{$errors->has('title') ? '' : 'valid'}}">
                                        </th>

                                        <th></th>
                                    </tr>
                                    <tbody>
                                    @if($pages)
                                        @foreach($pages as $page)
                                            <tr>
                                                <td>{{$page->id}}</td>
                                                <td>{{$page->key}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <ul class="tabs">
                                                                @foreach($page->languages as $key => $language)
                                                                    @if(isset($languages[$language->language_id]))
                                                                        <li class="tab ">
                                                                            <a href="#title-{{$page->id}}-{{$language->language_id}}">
                                                                                {{$languages[$language->language_id]->locale}}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                        <div class="col sm12 mt-2">
                                                            @foreach($page->languages as $key => $language)
                                                                @if(isset($languages[$language->language_id]))
                                                                    <div
                                                                        id="title-{{$page->id}}-{{$language->language_id}}"
                                                                        class="">
                                                                        {{$language->title}}
                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                        </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{locale_route('page.show',$page->id)}}">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                    <a href="{{locale_route('page.edit',$page->id)}}"
                                                       class="pl-3">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                </td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </form>
                            {{--                            {{ $blogs->appends(request()->input())->links('admin.vendor.pagination.material') }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


