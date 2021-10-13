{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')
{{-- page title --}}
@section('title', $gallery->created_at ? __('admin.gallery-update') : 'admin.gallery-create')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection
{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/dropify/css/dropify.min.css')}}">
@endsection

@section('content')

    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <input name="old-images[]" id="old_images" hidden disabled value="{{$gallery->files}}">
                    <h4 class="card-title">{{$gallery->created_at ? __('admin.gallery-update') : __('admin.gallery-create')}}</h4>
                    {!! Form::model($gallery,['url' => $url, 'method' => $method,'files' => true]) !!}
                    {!! Form::text('old_main_image',$gallery->mainFile,['hidden','id'=>'old-main']) !!}

                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::text('url',$gallery->video_link ,['class' => 'validate '. $errors->has('url') ? '' : 'valid']) !!}
                            {!! Form::label('url',__('admin.url')) !!}
                            @error('url')
                            <small class="errorTxt4">
                                <div class="error">
                                    {{$message}}
                                </div>
                            </small>
                            @enderror
                        </div>
                        {{--                        slider not useing --}}

                        {{--                        <div class="input-field col s12">--}}

                        {{--                            <select class="select2-customize-result browser-default" multiple="multiple" name="slider_id[]" >--}}
                        {{--                                <option value="" disabled>Choose your option</option>--}}
                        {{--                                @foreach($sliders as $key => $slider)--}}
                        {{--                                    <option value="{{ $slider->id }}"--}}
                        {{--                                            {{ in_array($slider->id, $gallerySliders) ? "selected": ""}}--}}
                        {{--                                    >--}}
                        {{--                                        {{ $slider->language()->title }}--}}
                        {{--                                    </option>--}}

                        {{--                                @endforeach--}}
                        {{--                            </select>--}}

                        {{--                        </div>--}}
                        <ul class="tabs">
                            @foreach($languages as $key => $language)
                                <li class="tab col ">
                                    <a href="#lang-{{$key}}">{{$language->locale}}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="col s12 mb-2 mt-4">
                            <label>

                                {!! Form::checkbox('status', 'true', $gallery->status ? 'checked' : '') !!}
                                <span>{{__('admin.status')}}</span>
                            </label>
                        </div>
                        @foreach($languages as $key => $language)
                            <div id="lang-{{$key}}" class="col s12  mt-5">
                                {{--                                <div class="input-field">--}}
                                {{--                                        <select class="form-control" name="slider">--}}
                                {{--                                            @foreach($sliders as $key => $slider)--}}
                                {{--                                                @foreach($slider->languages as $key => $sliderlang)--}}
                                {{--                                                    @if($sliderlang->language_id == $language->id )--}}
                                {{--                                                        <option value="{{ $slider->id }}">{{ $sliderlang->title }}</option>--}}
                                {{--                                                    @endif--}}
                                {{--                                                @endforeach--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}
                                {{--                                </div>--}}
                                <div class="input-field ">
                                    {{--                                    @dd($gallery->language())--}}
                                    {!! Form::text('title['.$key.']',$gallery->language($language->id) !== null ? $gallery->language($language->id)->title:  '',['class' => 'validate '. ($errors->has('title.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('title['.$key.']',__('admin.title')) !!}
                                    @error('title.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::textarea('description['.$key.']',$gallery->language($language->id) !== null ? $gallery->language($language->id)->description : "",['class' => 'validate materialize-textarea '. ($errors->has('description.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('description['.$key.']',__('admin.description')) !!}

                                    @error('description.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::textarea('short-description['.$key.']',$gallery->language($language->id) !== null ? $gallery->language($language->id)->short_description : "",['class' => 'validate materialize-textarea '. ($errors->has('short-description.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('short-description['.$key.']',__('admin.short_description')) !!}

                                    @error('short_description.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::textarea('content['.$key.']',$gallery->language($language->id) !== null ? $gallery->language($language->id)->content : "",['class' => 'validate materialize-textarea '.($errors->has('content.*') ? '' : 'valid'),'id'=>'content-'.$language->locale]) !!}

                                    @error('content.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::text('slug['.$key.']',$gallery->language($language->id) !== null ? $gallery->language($language->id)->slug : "",['class' => 'validate '. ($errors->has('slug.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('slug['.$key.']',__('admin.slug')) !!}
                                    @error('slug.*')
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
                    <label>{{__('client.main_image')}}</label>
                    <div class="form-group">
                        <input name="main-image" type="file" id="input-file-now" class="dropify"
                               data-default-file="{{$gallery->mainFile?asset($gallery->mainFile->path.'/'.$gallery->mainFile->title):""}}"/>
                        @if ($errors->has('main-image'))
                            <span class="help-block">
                                            {{ $errors->first('main-image') }}
                                        </span>
                        @endif
                    </div>
                    <br>
                    <label>{{__('client.slider_images')}}</label>
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
                            {!! Form::submit($gallery->created_at ? __('admin.update') : __('admin.create'),['class' => 'btn cyan waves-effect waves-light right']) !!}
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
        CKEDITOR.replace('content-{{$item['locale']}}', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token(),'type'=>'gallery'])}}",
            filebrowserUploadMethod: 'form'
        });
        @endforeach
        CKEDITOR.replace('content-{{$localizations['current']['locale']}}', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token(),'type'=>'gallery'])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

@endsection

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/form-select2.js')}}"></script>
    <script src="{{asset('js/scripts/form-file-uploads.js?v='.time())}}"></script>
@endsection
