{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')
{{-- page title --}}
@section('title',  __('admin.page-update'))

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection
{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <input name="old-images[]" id="old_images" hidden disabled value="{{$page->files}}">
                    <h4 class="card-title">{{ __('admin.page-update') }}</h4>
                    {!! Form::model($page,['url' => $url, 'method' => $method,'files' => true]) !!}
                    <div class="row">
                        <ul class="tabs">
                            @foreach($languages as $key => $language)
                                <li class="tab col ">
                                    <a href="#lang-{{$key}}">{{$language->locale}}</a>
                                </li>
                            @endforeach
                        </ul>
                        {{--                        <div class="col s12 mb-2 mt-4">--}}
                        {{--                            <label>--}}
                        {{--                                <input type="checkbox" name="status"--}}
                        {{--                                       value="true" {{$blog->status ? 'checked' : ''}}>--}}
                        {{--                                {!! Form::checkbox('status', 'true', $blog->status ? 'checked' : '') !!}--}}
                        {{--                                <span>{{__('admin.status')}}</span>--}}
                        {{--                            </label>--}}
                        {{--                        </div>--}}
                        @foreach($languages as $key => $language)
                            <div id="lang-{{$key}}" class="col s12  mt-5">
                                <div class="input-field ">
                                    {!! Form::text('title['.$key.']',$page->language($language->id) !== null ? $page->language($language->id)->title : "",['class' => 'validate '. ($errors->has('title.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('title['.$key.']',__('admin.title')) !!}
                                    @error('title.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                {{--                                <div class="input-field ">--}}
                                {{--                                    {!! Form::textarea('description['.$key.']',$page->language($language->id) !== null ? $page->language($language->id)->description : "",['class' => 'validate materialize-textarea '. ($errors->has('description.*') ? '' : 'valid')]) !!}--}}
                                {{--                                    {!! Form::label('description['.$key.']',__('admin.description')) !!}--}}

                                {{--                                    @error('description.*')--}}
                                {{--                                    <small class="errorTxt4">--}}
                                {{--                                        <div class="error">--}}
                                {{--                                            {{$message}}--}}
                                {{--                                        </div>--}}
                                {{--                                    </small>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}

{{--                                <div class="input-field">--}}
{{--                                    <h5 for="description">@lang('admin.description')</h5>--}}
{{--                                    <textarea class="form-control" id="description-{{$locale}}"--}}
{{--                                              name="{{$locale}}[description]'">--}}
{{--                                                {!! $page->translate($locale)->description ?? '' !!}--}}
{{--                                            </textarea>--}}
{{--                                    @error($locale.'.description')--}}
{{--                                    <small class="errorTxt4">--}}
{{--                                        <div class="error">--}}
{{--                                            {{$message}}--}}
{{--                                        </div>--}}
{{--                                    </small>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

                                <div class="input-field ">
                                    {!! Form::textarea('content_1['.$key.']',$page->language($language->id) !== null ? $page->language($language->id)->content_1 : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('content_1.*') ? '' : 'valid'),'id'=>'content-1-'.$language->locale]) !!}
                                    {{--                                    {!! Form::label('content['.$key.']',__('admin.content')) !!}--}}

                                    @error('content_1.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::textarea('content_2['.$key.']',$page->language($language->id) !== null ? $page->language($language->id)->content_2 : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('content_2.*') ? '' : 'valid'),'id'=>'content-2-'.$language->locale]) !!}
                                                                        {!! Form::label('content_2['.$key.']',__('admin.content_2')) !!}

                                    @error('content_2.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>


                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <div class="input-images"></div>
                        @if ($errors->has('images'))
                            <span class="help-block">
                                            {{ $errors->first('images') }}
                                        </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::submit( __('admin.update') ,['class' => 'btn cyan waves-effect waves-light right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

    <script src="{{asset("ckeditor/ckeditor.js")}}"></script>
    <script>


        @foreach($localizations['data'] as $item)
        CKEDITOR.replace('content-1-{{$item['locale']}}', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token(),'type'=>'page'])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('content-2-{{$item['locale']}}', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token(),'type'=>'page'])}}",
            filebrowserUploadMethod: 'form'
        });
        @endforeach
        CKEDITOR.replace('content-1-{{$localizations['current']['locale']}}', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token(),'type'=>'page'])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('content-2-{{$localizations['current']['locale']}}', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token(),'type'=>'page'])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/form-select2.js')}}"></script>
@endsection
